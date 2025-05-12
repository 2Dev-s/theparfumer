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
        $sex = $request->get('collection');
        $brand = $request->get('brand');
        $sort = $request->get('sort');
        $search = $request->get('search');
        $category = $request->get('category');

        $perfumes = Perfume::where('active', 1)->with(['brand', 'category']);

        if ($search) {
            $perfumes->where('name', 'like', '%' . $search . '%');
        }

        if ($sex) {
            $perfumes->where('sex', $sex);
        }

        if ($brand) {
            $perfumes->where('brand_id', $brand);
        }

        if ($category) {
            $perfumes->where('category_id', $category);
        }

        if ($sort) {
            if ($sort === 'price_asc') {
                $perfumes->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $perfumes->orderBy('price', 'desc');
            } elseif ($sort === 'new_arrival') {
                $perfumes->where('created_at', '>=', now()->subDays(30));
            }
        }

        $brands = Brand::where('active', 1)->get();
        $categories = Category::where('active', 1)->get();

        $perfumes = $perfumes->get();

        return Inertia::render('Perfumes', [
            'perfumes' => $perfumes ?? [],
            'brands' => $brands ?? [],
            'categories' => $categories ?? [],
            'sex' => $sex,
            'brand' => $brand,
            'search' => $search,
            'sort' => $sort,
        ]);
    }

    public function show($slug)
    {
        $perfume = Perfume::with(['brand', 'category', 'media'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedParfumes = Perfume::with(['brand', 'category', 'media'])
            ->where('category_id', $perfume->category->id)
            ->where('id', '!=', $perfume->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return Inertia::render('Perfum', [
            'perfume' => $perfume,
            'relatedParfumes' => $relatedParfumes,
        ]);
    }
}
