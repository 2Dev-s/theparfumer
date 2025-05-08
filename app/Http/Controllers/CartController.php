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
        $product = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'sometimes|integer|min:1',
            'image' => 'sometimes|string'
        ]);

        $cart = session()->get('cart', []);
        $productId = $product['id'];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $product['quantity'] ?? 1;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $product['quantity'] ?? 1,
                'image' => $product['image'] ?? ''
            ];
        }

        session()->put('cart', $cart);

        return $this->getCart();
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
