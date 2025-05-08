<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCart()
    {
        return response()->json([
            'cart' => array_values(session()->get('cart', []))
        ]);
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'sometimes|integer|min:1',
            // Make other fields optional or adjust as needed
            'slug' => 'sometimes|string',
            'brand' => 'sometimes|array',
            'brand.name' => 'sometimes|string',
            'image' => 'sometimes|string',
        ]);

        $cart = session()->get('cart', []);
        $productId = $validated['id'];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $validated['quantity'] ?? 1;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $validated['name'],
                'price' => $validated['price'],
                'quantity' => $validated['quantity'] ?? 1,
                // Optional fields
                'slug' => $validated['slug'] ?? null,
                'brand' => $validated['brand'] ?? null,
                'image' => $validated['image'] ?? null,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'count' => count($cart),
        ]);
    }

    public function updateCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return $this->getCart();
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return $this->getCart();
    }
}
