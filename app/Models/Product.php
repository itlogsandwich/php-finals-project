<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'image_url',
    ];

    public function listing()
    {
        return $this->hasMany(Listing::class, 'product_id');
    }
}
