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
            // Calculate total amount and prepare line items
            $totalAmount = 0;
            $lineItems = [];
            $productDetails = [];

            foreach ($validated['products'] as $item) {
                $product = Perfume::where('price_id', $item['price_id'])->firstOrFail();

                $lineItems[] = [
                    'price' => $item['price_id'],
                    'quantity' => $item['quantity']
                ];

                $productDetails[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price_id' => $item['price_id']
                ];

                $totalAmount += $product->price * $item['quantity'];
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

            if (auth()->check()) {
                $address = auth()->user()->addresses()->where('is_default', true)->first();
            }

            $orderNumber = 'ORD-' . now()->format('Ymd') . '-' . str_pad(Order::max('id') + 1, 4, '0', STR_PAD_LEFT);

            // Create order record
            $order = Order::create([
                'user_id' => auth()->id() ?? null,
                'order_number' => $orderNumber,
                'stripe_session_id' => $checkout_session->id,
                'status' => 'pending',
                'total_amount' => $totalAmount,
                'currency' => 'RON', // Default currency, will be updated from Stripe in success callback
                'customer_name' => auth()->user() ? auth()->user()->name : 'Guest Customer',
                'customer_email' => auth()->user() ? auth()->user()->email : 'email@address.ro',
                'street' => $address->street ?? '',
                'city' => $address->city ?? '',
                'state' => $address->state ?? '',
                'postal_code' => $address->postal_code ?? '',
                'country' => $address->country ?? '',
                'phone' => $address->phone ?? '',
                'company_name' => $address->company_name ?? '',
                'tax_id' => $address->tax_id ?? '',
            ]);

            // Create order products
            foreach ($productDetails as $item) {
                $products = OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'stripe_price_id' => $item['price_id'],
                    'name' => $item['product']->name,
                    'price' => $item['product']->price,
                    'quantity' => $item['quantity'],
                ]);
            }

            session()->forget('cart');

            return response()->json([
                'url' => $checkout_session->url,
                'order_id' => $order->id
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
                $request->get('session_id')
            );

            // Create or update order
            $order = Order::firstOrNew(['stripe_session_id' => $session->id]);

            $order->status = 'pending';
            $order->total_amount = $session->amount_total / 100;
            $order->currency = strtoupper($session->currency);

            if (empty($order->customer_name)) {
                $order->customer_name = $session->customer_details->name ?? 'Customer';
            }

            if (empty($order->customer_email)) {
                $order->customer_email = $session->customer_details->email ?? '';
            }

            $order->save();


            if (auth()->check()) {
                $address = auth()->user()->addresses()->where('is_default', true)->first();

                if (!$address)
                {
                    return Inertia::render('Checkout/FillAddress', [
                        'customerName' => $session->customer_details->name ?? 'Customer',
                        'orderNumber' => $order->order_number,
                        'amount' => number_format($session->amount_total / 100, 2),
                        'currency' => strtoupper($session->currency),
                        'session_id' => $request->get('session_id')
                    ]);
                }

                return Inertia::render('Checkout/RealSuccess', [
                    'customerName' => $order->customer_name ?? 'Customer',
                    'orderNumber' => $order->order_number,
                    'amount' => $order->total_amount ?? 0,
                    'currency' => strtoupper($order->currency),
                ]);
            }

            return Inertia::render('Checkout/FillAddress', [
                'customerName' => $session->customer_details->name ?? 'Customer',
                'amount' => number_format($session->amount_total / 100, 2),
                'currency' => strtoupper($session->currency),
                'session_id' => $request->get('session_id')
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
