<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
