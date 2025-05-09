<?php

namespace App\Http\Controllers;

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

    public function perfumes(Request $request)
    {
        $perfumes = Perfume::where('active', 1)->with(['brand', 'category']);

        if ($request->has('collection')) {
            $collection = $request->query('collection');
            $perfumes = $perfumes->where('sex', $collection);
        }

        $perfumes = $perfumes->get();

        return Inertia::render('Perfumes', [
            'perfumes' => $perfumes,
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
