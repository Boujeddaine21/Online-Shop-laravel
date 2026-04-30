<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $products = Auth::user()->wishlist()->get();
        return view('user.wishlist', ['products' => $products]);
    }

    public function toggle(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $user = Auth::user();
        $productId = $request->product_id;

        $exists = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($exists) {
            $exists->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            $status = 'added';
        }

        if ($request->wantsJson()) {
            return response()->json(['status' => $status]);
        }

        return back();
    }
}
