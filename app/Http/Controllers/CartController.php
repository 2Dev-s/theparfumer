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
            'slug' => 'required|string',
            'brand_id' => 'required|integer',
            'brand' => 'required|array',
            'brand.id' => 'required|integer',
            'brand.name' => 'required|string',
            'category_id' => 'required|integer',
            'category' => 'required|array',
            'category.id' => 'required|integer',
            'category.name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'size' => 'required|string',
            'stock' => 'required|integer',
            'concentration' => 'required|string',
            'top_notes' => 'required|array',
            'top_notes.*' => 'string',
            'middle_notes' => 'required|array',
            'middle_notes.*' => 'string',
            'base_notes' => 'required|array',
            'base_notes.*' => 'string',
            'quantity' => 'sometimes|integer|min:1',
            'image' => 'sometimes|string',
            'active' => 'required|boolean',
        ]);

        $cart = session()->get('cart', []);
        $productId = $product['id'];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $product['quantity'] ?? 1;
        } else {

            $cart[$productId] = [
                'id' => $productId,
                'product' => $product,
                'quantity' => $product['quantity'] ?? 1,
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
