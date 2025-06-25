<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Code;

class CartController extends Controller
{
    public function view()
    {
        $cart = $this->getCart()->getData(true);
        $user = auth()->user();

        $addresses = [
            'personalAddress' => null,
            'companyAddress' => null
        ];

        if ($user) {
            $addresses = [
                'personalAddress' => $user->addresses()->where('type', 'personal')->first(),
                'companyAddress' => $user->addresses()->where('type', 'company')->first()
            ];
        }

        $promotionalCode = Code::where('popup', true)->first() ?? null;

        return Inertia::render('Cart', array_merge([
            'products' => $cart['cart'],
            'promotionalCode' => $promotionalCode
        ], $addresses));
    }

    public function getCart()
    {
        return response()->json([
            'cart' => array_values(session()->get('cart', [])),
        ]);
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->get('slug');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $validated['quantity'] ?? 1;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'quantity' => $request->get('quantity') ?? 1,
                'size' => $request->get('size') ?? 0,
                'concentration' => $request->get('concentration') ?? null,
                'slug' => $request->get('slug') ?? null,
                'price_id' => $request->get('price_id') ?? null,
                'brand' => $request->get('brand') ?? null,
                'image' => $request->get('image') ?? null,
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

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);

        $code = Code::where('code', $request->code)
                    ->where('active', true)
                    ->first();

        if (!$code) {
            return response()->json([
                'valid' => false,
                'message' => 'Cod promoțional invalid'
            ]);
        }

        return response()->json([
            'valid' => true,
            'code' => $code->code,
            'discount' => $code->discount
        ]);
    }
}
