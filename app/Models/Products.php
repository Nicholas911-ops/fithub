<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    use HasFactory;

        // Add any fillable fields
        protected $fillable = ['product_name', 'product_description', 'product_price', 'product_image'];
    
}