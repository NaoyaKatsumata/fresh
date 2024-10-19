<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainController extends Controller{
    const UPPER = 'highest'; //降順用
    const LOWER = 'lowest'; //昇順用

    public function mainView(Request $request){
        $sort = $request->sort;
        $fruitName = $request->fruitName;

        if($sort === $this::UPPER){
            if(!empty($fruitName)){
                $fruits = Product::where('name','like',"%".$fruitName."%")
                ->orderBy('price','desc')
                ->paginate(6);
            }else{
                $fruits = Product::orderBy('price','desc')->paginate(6);
            }
            
        }elseif($sort === $this::LOWER){
            if(!empty($fruitName)){
                $fruits = Product::where('name','like',"%".$fruitName."%")
                ->orderBy('price','asc')
                ->paginate(6);
            }else{
                $fruits = Product::orderBy('price','asc')->paginate(6);
            }
        }else{
            if(!empty($fruitName)){
                $fruits = Product::where('name','like',"%".$fruitName."%")
                ->paginate(6);
            }else{
                $fruits = Product::paginate(6);
            }
        }

        return view('main',compact('fruits','sort','fruitName'));
    }

    public function search(Request $request){
        $fruitName = $request->fruitName;
        $sort='';
        $fruits = Product::where('name','like',"%".$fruitName."%")->paginate(6);

        return view('main',compact('fruits','sort','fruitName'));
    }

    public function description($productId){

        return view('description');
    }
}
