<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSeason;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','image','description'];

    public function productSeason()
    {
        return $this->hasMany(ProductSeason::class,'product_id','id');
    }
}
