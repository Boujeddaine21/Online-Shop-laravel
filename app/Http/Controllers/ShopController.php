<?php

namespace App\Http\Controllers;

use App\Models\Categorie;

class ShopController extends Controller
{
    public function showCategorie()
    {
        $categories = Categorie::all();
        return view("user.categorie", [
            "categories" => $categories
        ]);
    }

    public function showProduct($id)
    {
        $categorie = Categorie::with('product')->find($id);

        if (!$categorie) {
            return response()->json(['error' => 'Kategorie nicht gefunden'], 404);
        }

        return response()->json([
            'categorie_id' => $id,
            'name' => $categorie->name,
            'products' => $categorie->product
        ]);
    }
}
