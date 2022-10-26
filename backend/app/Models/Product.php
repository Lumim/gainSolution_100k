<?php

namespace App\Models;

use App\Models\ProductVariants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function ProductVariants(){
        return $this->hasMany(ProductVariants::class);
    }
   
}
