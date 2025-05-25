<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.price_id' => 'required|string',
            'products.*.quantity' => 'required|integer|min:1'
        ]);

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $domain = env('STRIPE_DOMAIN', 'http://localhost:8000');

        $lineItems = array_map(function ($item) {
            return [
                'price' => $item['price_id'],
                'quantity' => $item['quantity']
            ];
        }, $validated['products']);

        // Add apple pay and google pay methods + cupons
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $domain . '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $domain . '/checkout/canceled',
            'locale' => 'ro',
            'allow_promotion_codes' => true,
            'metadata' => [
                'user_id' => auth()->id()
            ]
        ]);

        if ($checkout_session) {
            session()->forget('cart'); // Clear session cart
            // Create order for user
        }
        return response()->json(['url' => $checkout_session->url]);
    }

    public function success(Request $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        try {
            $session = $stripe->checkout->sessions->retrieve(
                $request->get('session_id')
            );

            return Inertia::render('Checkout/Success', [
                'customerName' => $session->customer_details->name ?? 'Customer',
                'amount' => number_format($session->amount_total / 100, 2),
                'currency' => strtoupper($session->currency)
            ]);

        } catch (ApiErrorException $e) {
            return redirect()->route('dashboard')
                ->with('error', 'Failed to verify payment: ' . $e->getMessage());
        }
    }

    public function canceled(Request $request)
    {
        return Inertia::render('Checkout/Canceled');
    }
}
