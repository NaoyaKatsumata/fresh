<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSeason;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function productSeason()
    {
        return $this->hasMany(ProductSeason::class,'season_id','id');
    }
}
