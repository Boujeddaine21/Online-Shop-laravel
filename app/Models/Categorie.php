<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    use HasFactory;

    const BOOK = 1;
    const TABLET = 2;
    const LAPTOP = 3;
    const PHONE = 4;

    public function product(){
        return $this->hasMany(Product::class);
    }
}
