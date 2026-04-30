<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');

        $products = collect();

        if (strlen($query) >= 2) {
            $products = Product::where('is_active', true)
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                })
                ->take(20)
                ->get();
        }

        // JSON-Response für Live-Suche
        if ($request->wantsJson()) {
            return response()->json([
                'products' => $products->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'name' => $p->name,
                        'price' => $p->price,
                        'image' => $p->image,
                    ];
                }),
            ]);
        }

        return view('search', [
            'products' => $products,
            'query' => $query,
        ]);
    }
}
