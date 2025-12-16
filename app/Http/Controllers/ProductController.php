<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $products = Product::paginate(20);
        //dd($products);
        return view("admin.index", [
            "products"=> $products
        ]);
    }

    public function create(){
        $attributes = Request()->validate([
            "categorie_id"=> ["required"],
            "name"=> ["required","string"],
            "description"=> ["required","string"],
            "price"=> ["required","integer"],
            "quantity"=> ["required","integer"],
            "image"=> ["required","url"],
        ]);
        $attributes["is_active"] = true;
        Product::create($attributes);
        return redirect('/admin/products')->with('successCreate','Great ! your new product is successfully created');
    }

    public function update(Product $product){
        //dd(Request()->all());
        $attributes = Request()->validate([
            "categorie_id"=> ["required"],
            "name"=> ["required","string"],
            "description"=> ["required","string"],
            "price"=> ["required","integer"],
            "quantity"=> ["required","integer"],
            "image"=> ["required","url"],
        ]);

        $product->update($attributes);

        return redirect('/admin/products')->with('successUpdate','Great ! Your update is successfully');
    }

    public function delete(Product $product){
        $product->delete();
        return redirect('/admin/products');
    }

}
