<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProductController extends Controller{

    public function showProducts(){
        return view('user.products');
    }
}
