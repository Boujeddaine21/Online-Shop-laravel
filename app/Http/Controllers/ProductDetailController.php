<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductDetailController extends Controller
{
    public function show(Product $product)
    {
        $product->load('categorie');

        $relatedProducts = Product::where('categorie_id', $product->categorie_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('product-detail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
