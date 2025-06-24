<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use App\Models\RoomPerfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index(Request $request)
    {
        $favorites = $request->session()->get('favorites', []);

        $perfumes = Perfume::whereIn('slug', $favorites)->get();
        $roomPerfumes = RoomPerfume::whereIn('slug', $favorites)->get();

        // Merge collections and add type indicator
        $allItems = $perfumes->map(fn($item) => $item->setAttribute('type', 'perfume'))
            ->concat(
                $roomPerfumes->map(fn($item) => $item->setAttribute('type', 'room_perfume'))
            );

        return response()->json($allItems);
    }

    public function toggleFavourite(Request $request, $perfume)
    {
        $favorites = $request->session()->get('favorites', []);

        $perfume = Perfume::where('slug', $perfume)->first()
            ?? RoomPerfume::where('slug', $perfume)->first();

        if (!$perfume) {
            throw new \InvalidArgumentException("No perfume found with slug: {$perfume}");
        }

        if (in_array($perfume->slug, $favorites)) {
            $favorites = array_diff($favorites, [$perfume->slug]);
            $status = 'removed';
        } else {
            $favorites[] = $perfume->slug;
            $status = 'added';
        }

        $request->session()->put('favorites', array_values($favorites));

        return response()->json([
            'status' => $status,
            'list' => $request->session()->get('favorites', []),
        ]);
    }

    private function handleRemoveAction(Request $request, $perfume)
    {
        $favorites = $request->session()->get('favorites', []);

        $favorites = array_diff($favorites, [$perfume->slug]);
        $status = 'removed';

        $request->session()->put('favorites', array_values($favorites));

        return response()->json(['status' => $status,]);
    }
}
