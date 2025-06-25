<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Parfum;
use App\Models\Settings;
use App\Models\Code;
use Illuminate\Http\Request;
use App\Models\Perfume;
use App\Models\RoomPerfume;
use Inertia\Inertia;

class DefaultPagesController extends Controller
{
    public function index()
    {
        $recommendedPerfumes = Perfume::where('active', 1)
            ->orderBy('price', 'desc')
            ->take(2)
            ->with(['brand'])
            ->get();

        $promotionalCode = Code::where('popup', true)->first() ?? null;

        return Inertia::render('Home', [
            'recommendedPerfumes' => $recommendedPerfumes,
            'promotionalCode' => $promotionalCode,
        ]);
    }

    public function home()
    {
        $recommendedPerfumes = Perfume::where('active', 1)
            ->orderBy('price', 'desc')
            ->take(2)
            ->with(['brand'])
            ->get();

        $promotionalCode = Code::where('popup', true)->first() ?? null;

        return Inertia::render('Home', [
            'recommendedPerfumes' => $recommendedPerfumes,
            'promotionalCode' => $promotionalCode,
        ]);
    }

    public function tos()
    {
        return Inertia::render('TOS');
    }

    public function pdc()
    {
        return Inertia::render('PDC');
    }

    public function roomPerfumes(Request $request)
    {
        $perfumes = RoomPerfume::where('active', 1)
                    ->with(['brand', 'category']);

        if ($request->has('brand')) {
            $brandParam = $request->get('brand');
            $perfumes->whereHas('brand', function($query) use ($brandParam) {
                $query->where('name', $brandParam)
                    ->orWhere('id', $brandParam);
            });
        }

        if ($request->has('category')) {
            $perfumes->where('category_id', $request->get('category'));
        }

        if ($request->has('search')) {
            $perfumes->where('name', 'like', '%' . $request->get('search') . '%');
        }

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

        $brands = Brand::where('active', 1)->get();
        $categories = Category::where('active', 1)->get();


        return Inertia::render('RoomPerfumes', [
            'perfumes' => $perfumes->get(),
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $request->only(['search', 'collection', 'brand', 'category', 'sort'])
        ]);
    }

    public function perfumes(Request $request): \Inertia\Response
    {
        $perfumes = Perfume::where('active', 1)
            ->with(['brand', 'category']);


        // Apply filters
        if ($request->has('collection')) {
            $perfumes->where('sex', $request->get('collection'));
        }

        if ($request->has('brand')) {
            $brandParam = $request->get('brand');
            $perfumes->whereHas('brand', function($query) use ($brandParam) {
                $query->where('name', $brandParam)
                    ->orWhere('id', $brandParam);
            });
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

        $brands = Brand::where('active', 1)->get();
        $categories = Category::where('active', 1)->get();

        return Inertia::render('Perfumes', [
            'perfumes' => $perfumes->get(),
            'brands' => $brands,
            'categories' => $categories,
            'filters' => $request->only(['search', 'collection', 'brand', 'category', 'sort'])
        ]);
    }

    public function perfum(Request $request, $slug)
    {
        $perfume = Perfume::with(['brand', 'category', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedParfumes = Perfume::with(['brand', 'category', 'media'])
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
        ]);
    }

    public function perfumRoom(Request $request, $slug)
    {
        $perfume = RoomPerfume::with(['brand', 'category', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedParfumes = RoomPerfume::with(['brand', 'category', 'media'])
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

        return Inertia::render('PerfumRoom', [
            'perfume' => $perfume,
            'relatedParfumes' => $relatedParfumes,
        ]);
    }
}
