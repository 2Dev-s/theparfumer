<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\ProfileUpdateRequest;
use App\Models\Perfume;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Show the user's profile settings page.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('settings/Profile', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile.edit');
    }

    public function toggleFavourite(Request $request, Perfume $perfume)
    {
        $favorites = $request->session()->get('favorites', []);

        if (in_array($perfume->id, $favorites)) {
            // Remove from favorites
            $favorites = array_diff($favorites, [$perfume->id]);
            $status = 'removed';
        } else {
            // Add to favorites
            $favorites[] = $perfume->id;
            $status = 'added';
        }

        $request->session()->put('favorites', array_values($favorites));

        return response()->json([
            'status' => $status,
            'favorites' => $favorites
        ]);
    }

    public function userFavorites(Request $request)
    {
        $favoriteIds = $request->session()->get('favorites', []);
        $products = Perfume::whereIn('id', $favoriteIds)->get();

        return Inertia::render('settings/Favourite', [
            'products' => $products,
        ]);
    }

    public function userOrders(Request $request)
    {
        $orders = $request->user()->orders()
            ->with(['products' => function($query) {
                $query->with('product'); // Eager load product details
            }])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'status' => $order->status,
                    'total_amount' => $order->total_amount,
                    'currency' => $order->currency,
                    'created_at' => $order->created_at->format('d M Y, H:i'),
                    'products' => $order->products->map(function($product) {
                        return [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'quantity' => $product->quantity,
                            'image_url' => $product->product->main_image_url ?? null,
                            'concentration' => $product->product->concentration ?? '',
                            'size' => $product->product->size ?? ''
                        ];
                    })
                ];
            });

        return Inertia::render('settings/Orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Delete the user's profile.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
