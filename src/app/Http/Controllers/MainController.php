<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainController extends Controller
{
    public function mainView(){
        $fruits = Product::paginate(6);

        return view('main',['fruits'=>$fruits]);
    }
}
