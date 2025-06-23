<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index(Request $request)
    {
        // For guests - get from session
        if (!Auth::check()) {
            $favorites = $request->session()->get('favorites', []);
            $perfumes = Perfume::whereIn('id', $favorites)->get();
            return response()->json($perfumes);
        }

        // For authenticated users - get from database
        $perfumes = $request->user()->favorites()->get();
        return response()->json($perfumes);
    }

    public function toggleFavourite(Request $request, Perfume $perfume)
    {
        // For guests - use session
        if (!Auth::check()) {
            $favorites = $request->session()->get('favorites', []);

            if (in_array($perfume->id, $favorites)) {
                $favorites = array_diff($favorites, [$perfume->id]);
                $status = 'removed';
            } else {
                $favorites[] = $perfume->id;
                $status = 'added';
            }

            $request->session()->put('favorites', array_values($favorites));
            return response()->json(['status' => $status]);
        }

        // For authenticated users - use database
        $user = $request->user();

        if ($user->favorites()->where('perfume_id', $perfume->id)->exists()) {
            $user->favorites()->detach($perfume);
            return response()->json(['status' => 'removed']);
        }

        $user->favorites()->attach($perfume);
        return response()->json(['status' => 'added']);
    }
}
