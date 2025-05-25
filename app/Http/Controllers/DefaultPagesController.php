<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Parfum;
use Illuminate\Http\Request;
use App\Models\Perfume;
use Inertia\Inertia;

class DefaultPagesController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }

    public function home()
    {
        return Inertia::render('Home');
    }

    public function tos()
    {
        return Inertia::render('TOS');
    }

    public function pdc()
    {
        return Inertia::render('PDC');
    }

    public function perfumes(Request $request)
    {
        $user = $request->user();
        $perfumes = Perfume::where('active', 1)
            ->with(['brand', 'category'])
            ->when($user, function ($query) use ($user) {
                $query->with(['favorites' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }]);
            });

        // Apply filters
        if ($request->has('collection')) {
            $perfumes->where('sex', $request->get('collection'));
        }

        if ($request->has('brand')) {
            $perfumes->where('brand_id', $request->get('brand'));
        }

        if ($request->has('category')) {
            $perfumes->where('category_id', $request->get('category'));
        }

        if ($request->has('search')) {
            $perfumes->where('name', 'like', '%' . $request->get('search') . '%');
        }

        // Apply sorting
        switch ($request->get('sort')) {
            case 'price_asc':
                $perfumes->orderBy('price');
                break;
            case 'price_desc':
                $perfumes->orderBy('price', 'desc');
                break;
            case 'new_arrival':
                $perfumes->where('created_at', '>=', now()->subDays(30));
                break;
        }

        // Get results with favorite status
        $perfumes = $perfumes->get()->map(function ($perfume) use ($user) {
            $perfume->is_favorite = $user ? $perfume->favorites->isNotEmpty() : false;
            return $perfume;
        });

        $brands = Brand::where('active', 1)->get();
        $categories = Category::where('active', 1)->get();

        return Inertia::render('Perfumes', [
            'perfumes' => $perfumes,
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $request->only(['search', 'collection', 'brand', 'category', 'sort'])
        ]);
    }

    public function show(Request $request, $slug)
    {
        $perfume = Perfume::with(['brand', 'category', 'media', 'favorites'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Check if the perfume is in the user's favourites
        $isFavourite = auth()->check()
            ? $perfume->favorites->contains('id', auth()->id())
            : false;

        $relatedParfumes = Perfume::with(['brand', 'category', 'media', 'favorites'])
            ->where('category_id', $perfume->category->id)
            ->where('id', '!=', $perfume->id)
            ->inRandomOrder()
            ->limit(4)
            ->get()
            ->each(function ($related) {
                $related->is_favorite = auth()->check()
                    ? $related->favorites->contains('user_id', auth()->id())
                    : false;
            });

        return Inertia::render('Perfum', [
            'perfume' => $perfume,
            'relatedParfumes' => $relatedParfumes,
            'is_favourite' => $isFavourite,
        ]);
    }
}
