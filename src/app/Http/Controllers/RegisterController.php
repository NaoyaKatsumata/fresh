<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSeason;
use App\Http\Requests\StoreDataRequest;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    const SPRING_ID = 1;
    const SUMMER_ID = 2;
    const AUTUMN_ID = 3;
    const WINTER_ID = 4;

    public function register(StoreDataRequest $request){
        $fruitId = $request->id;
        $fruitName = $request->name;
        $price = $request->price;
        $description = $request->description;
        $file = $request->file('image')->store('img', 'public');
        $url = Storage::url($file);
        $selectedSeasons = [
            'spring' => $request->has('spring'),
            'summer' => $request->has('summer'),
            'autumn' => $request->has('autumn'),
            'winter' => $request->has('winter')
        ];

        $newProduct = Product::create([
            'name' => $fruitName,
            'price' => $price,
            'image' => $url,
            'description' => $description
        ]);

        foreach ($selectedSeasons as $season => $isChecked) {
            if ($isChecked) {
                $seasonId ='';
                switch($season){
                    case 'spring':
                        $seasonId=$this::SPRING_ID;
                        break;
                    case 'summer':
                        $seasonId=$this::SUMMER_ID;
                        break;
                    case 'autumn':
                        $seasonId=$this::AUTUMN_ID;
                        break;
                    case 'winter':
                        $seasonId=$this::WINTER_ID;
                        break;
                }

                ProductSeason::create([
                    'product_id' => $newProduct->id,
                    'season_id' => $seasonId
                ]);
            }
        }

        $url = Storage::url($file);

        return redirect('/products');
    }
}
