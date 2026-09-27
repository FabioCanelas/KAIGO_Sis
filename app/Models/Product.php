<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'category_id', 'brand_id', 'name', 'slug', 'description', 
        'average_cost', 'price', 'stock', 'min_stock', 'is_active', 'is_featured'
    ];

    // Le decimos a Laravel: "Un Producto PERTENECE A una Categoría"
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
