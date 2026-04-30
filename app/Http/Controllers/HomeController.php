<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('product')->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('quantity', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return view('home', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
