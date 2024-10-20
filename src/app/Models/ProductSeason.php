<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductSeason extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','season_id'];
    protected $table = 'product_season';

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
