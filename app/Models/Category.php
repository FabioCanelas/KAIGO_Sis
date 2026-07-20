<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    // Le enseñamos la relación a Laravel: "Una Categoría tiene muchos Productos"
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
