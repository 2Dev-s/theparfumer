<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Perfume;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.price_id' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1',
            'address' => 'required|array',
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.postal_code' => 'required|string',
            'address.country' => 'required|string',
            'address.phone' => 'required|string',
            'address.company_name' => 'nullable|string',
            'address.tax_id' => 'nullable|string',
        ]);

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $domain = env('STRIPE_DOMAIN', 'https://theparfumer.test');

        try {
            $lineItems = [];

            foreach ($validated['products'] as $item) {
                $lineItems[] = [
                    'price' => $item['price_id'],
                    'quantity' => $item['quantity']
                ];
            }

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $domain . '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $domain . '/checkout/canceled?session_id={CHECKOUT_SESSION_ID}',
                'locale' => 'ro',
                'allow_promotion_codes' => true,
                'metadata' => [
                    'user_id' => auth()->id() ?? 'guest',
                    'address' => json_encode($validated['address']) // Store address in metadata
                ]
            ]);

            // Store address in session for later retrieval
            session()->put('checkout_address_' . $checkout_session->id, $validated['address']);

            return response()->json([
                'url' => $checkout_session->url,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Checkout failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function rambursSuccess(Order $order)
    {
        return Inertia::render('Checkout/RealSuccess', [
            'customerName' => $order->customer_name,
            'orderNumber' => $order->order_number,
            'amount' => $order->total_amount,
            'currency' => $order->currency,
        ]);
    }

    public function checkoutRamburs(Request $request)
    {
        $user = auth()->user();

        $orderNumber = 'ORD-' . now()->format('Ymd') . '-' . str_pad(Order::max('id') + 1, 4, '0', STR_PAD_LEFT);

        $address = $request->input('address', []);

        $orderData = [
            'user_id' => $user?->id,
            'order_number' => $orderNumber,
            'stripe_session_id' => $orderNumber, // Poate fi folosit ca identificator unic
            'status' => 'pending',
            'payment_method' => 'ramburs',
            'total_amount' => $request->get('total'),
            'currency' => strtoupper($request->get('currency', 'RON')),
            'customer_name' => $user ? $user->name : $request->get('name', 'Customer'),
            'customer_email' => $user ? $user->email : $request->get('email', ''),
            'street' => $address['street'] ?? '',
            'city' => $address['city'] ?? '',
            'state' => $address['state'] ?? '',
            'postal_code' => $address['postal_code'] ?? '',
            'country' => $address['country'] ?? '',
            'phone' => $address['phone'] ?? '',
            'company_name' => $address['company_name'] ?? null,
            'tax_id' => $address['tax_id'] ?? null,
        ];

        $order = Order::create($orderData);

        foreach ($request->get('products', []) as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'stripe_price_id' => $item['price_id'],
                'name' => $this->getProduct($item['price_id'])->name,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return response()->json([
            'success' => true,
            'order' => $order->id,
        ]);
    }



    public function success(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = $stripe->checkout->sessions->retrieve(
                $sessionId,
                ['expand' => ['line_items']]
            );

            if ($session->payment_status !== 'paid') {
                return redirect()->route('checkout.canceled', ['session_id' => $sessionId]);
            }

            $order = Order::where('stripe_session_id', $sessionId)->first();

            if (!$order) {
                $orderNumber = 'ORD-' . now()->format('Ymd') . '-' . str_pad(Order::max('id') + 1, 4, '0', STR_PAD_LEFT);

                // Retrieve address from session storage
                $address = session()->get('checkout_address_' . $sessionId, []);

                $orderData = [
                    'user_id' => auth()->id() ?? null,
                    'order_number' => $orderNumber,
                    'stripe_session_id' => $sessionId,
                    'status' => 'completed',
                    'payment_method' => 'card',
                    'total_amount' => $session->amount_total / 100,
                    'currency' => strtoupper($session->currency),
                    'customer_name' => $session->customer_details->name ?? 'Customer',
                    'customer_email' => $session->customer_details->email ?? '',
                    // Address fields
                    'street' => $address['street'] ?? '',
                    'city' => $address['city'] ?? '',
                    'state' => $address['state'] ?? '',
                    'postal_code' => $address['postal_code'] ?? '',
                    'country' => $address['country'] ?? '',
                    'phone' => $address['phone'] ?? '',
                    'company_name' => $address['company_name'] ?? null,
                    'tax_id' => $address['tax_id'] ?? null,
                ];

                $order = Order::create($orderData);

                foreach ($session->line_items->data as $item) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $this->getProduct($item['price_id'])->id,
                        'stripe_price_id' => $item->price->id,
                        'name' => $item->description,
                        'price' => $item->price->unit_amount / 100,
                        'quantity' => $item->quantity,
                    ]);
                }

                // Clear session address after successful order creation
                session()->forget('checkout_address_' . $sessionId);
                session()->forget('cart');
            }

            return Inertia::render('Checkout/RealSuccess', [
                'customerName' => $order->customer_name,
                'orderNumber' => $order->order_number,
                'amount' => $order->total_amount,
                'currency' => $order->currency,
            ]);

        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', 'Failed to verify payment: ' . $e->getMessage());
        }
    }

    private function getProductId($priceId)
    {
        return Perfume::where('price_id', $priceId)->value('id') ?? null;
    }

    private function getProduct($priceId)
    {
        return Perfume::where('price_id', $priceId)->first();
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'company_name' => 'nullable|string',
            'tax_id' => 'nullable|string',
            'session_id' => 'required|string',
        ]);

        // Update order with shipping details
        $order = Order::where('stripe_session_id', $validated['session_id'])->firstOrFail();

        $order->update([
            'street' => $validated['street'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
            'phone' => $validated['phone'],
            'company_name' => $validated['company_name'],
            'tax_id' => $validated['tax_id'],
        ]);

        return Inertia::render('Checkout/RealSuccess', [
            'customerName' => $order->customer_name ?? 'Customer',
            'amount' => $order->total_amount ?? 0,
            'orderNumber' => $order->order_number,
            'currency' => strtoupper($order->currency),
        ]);
    }

    public function canceled(Request $request)
    {
        $sessionId = $request->get('session_id');
        $customerName = 'Client'; // Default name

        try {
            // Retrieve Stripe session to get customer details
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $session = $stripe->checkout->sessions->retrieve($sessionId);

            // Update the order status to canceled
            $order = Order::where('stripe_session_id', $sessionId)->first();

            if ($order) {
                $order->update(['status' => 'canceled']);
                $customerName = $order->customer_name;
            }

            // Get customer name from session if not from order
            if (!$customerName || $customerName === 'Guest Customer') {
                $customerName = $session->customer_details->name ?? 'Client';
            }

        } catch (\Exception $e) {
            // Log error but still show the canceled page
        }

        return Inertia::render('Checkout/Canceled', [
            'customerName' => $customerName,
            'session_id' => $sessionId
        ]);
    }
}
