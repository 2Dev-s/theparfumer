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
                ]
            ]);

            session()->forget('cart');

            return response()->json([
                'url' => $checkout_session->url,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Checkout failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function success(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        try {
            $session = $stripe->checkout->sessions->retrieve(
                $request->get('session_id'),
                ['expand' => ['line_items']]
            );

            // Check if payment was successful
            if ($session->payment_status !== 'paid') {
                return redirect()->route('checkout.canceled', [
                    'session_id' => $session->id
                ]);
            }

            $order = Order::where('stripe_session_id', $session->id)->first();

            if (!$order) {
                $orderNumber = 'ORD-' . now()->format('Ymd') . '-' . str_pad(Order::max('id') + 1, 4, '0', STR_PAD_LEFT);

                $orderData = [
                    'user_id' => auth()->id() ?? null,
                    'order_number' => $orderNumber,
                    'stripe_session_id' => $session->id,
                    'status' => 'pending',
                    'total_amount' => $session->amount_total / 100,
                    'currency' => strtoupper($session->currency),
                    'customer_name' => $session->customer_details->name ?? 'Customer',
                    'customer_email' => $session->customer_details->email ?? '',
                ];

                // Add address if user is authenticated
                if (auth()->check()) {
                    $address = auth()->user()->addresses()->where('is_default', true)->first();
                    if ($address) {
                        $orderData = array_merge($orderData, [
                            'street' => $address->street,
                            'city' => $address->city,
                            'state' => $address->state,
                            'postal_code' => $address->postal_code,
                            'country' => $address->country,
                            'phone' => $address->phone,
                            'company_name' => $address->company_name,
                            'tax_id' => $address->tax_id,
                        ]);
                    }
                }

                $order = Order::create($orderData);

                foreach ($session->line_items->data as $item) {
                    $product = Perfume::where('price_id', $item->price->id)->first();

                    if ($product) {
                        OrderProduct::create([
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'stripe_price_id' => $item->price->id,
                            'name' => $product->name,
                            'price' => $item->price->unit_amount / 100,
                            'quantity' => $item->quantity,
                        ]);
                    }
                }

                session()->forget('cart');
            }

            if (auth()->check() && !$order->street) {
                return Inertia::render('Checkout/FillAddress', [
                    'customerName' => $order->customer_name,
                    'orderNumber' => $order->order_number,
                    'amount' => number_format($order->total_amount, 2),
                    'currency' => $order->currency,
                    'session_id' => $session->id
                ]);
            }

            // Handle guest users
            if (!auth()->check() && !$order->street) {
                return Inertia::render('Checkout/FillAddress', [
                    'customerName' => $order->customer_name,
                    'amount' => number_format($order->total_amount, 2),
                    'currency' => $order->currency,
                    'session_id' => $session->id
                ]);
            }

            return Inertia::render('Checkout/RealSuccess', [
                'customerName' => $order->customer_name,
                'orderNumber' => $order->order_number,
                'amount' => $order->total_amount,
                'currency' => $order->currency,
            ]);

        } catch (ApiErrorException $e) {
            return redirect()->route('home')
                ->with('error', 'Failed to verify payment: ' . $e->getMessage());
        }
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
