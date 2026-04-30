<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    protected $guarded = [];

    public function order(){
        return $this->belongsToMany(Order::class);
    }

    public function cart(){
        return $this->belongsToMany(Cart::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
}
