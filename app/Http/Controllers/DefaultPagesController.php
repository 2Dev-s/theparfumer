<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use Inertia\Inertia;

class DefaultPagesController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome');
    }

    public function home()
    {
        return Inertia::render('Home');
    }

    public function perfumes()
    {
        $perfumes = Perfume::where('active', 1)->with(['brand', 'category'])->get();

        return Inertia::render('Perfumes', [
            'perfumes' => $perfumes,
        ]);
    }

    public function show($slug)
    {
        $perfume = Perfume::with(['brand', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedParfumes = Perfume::with(['brand', 'category'])
            ->where('category_id', $perfume->category->id)
            ->where('id', '!=', $perfume->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return Inertia::render('Perfum', [
            'perfume' => $perfume,
            'relatedParfumes' => $relatedParfumes,
        ]);
    }
}
