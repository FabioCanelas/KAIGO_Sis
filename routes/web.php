<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\SiteContent;

Route::get('/', function () {
    // 1. Textos editables del sitio
    $siteContent = SiteContent::all()->pluck('setting_value', 'setting_key')->toArray();

    // 2. Traer solo los productos marcados como DESTACADOS (is_featured) para el Carrusel
    $featuredProducts = Product::with(['images', 'category'])
        ->where('is_active', true)
        ->where('is_featured', true)
        ->take(10) // Tomamos un máximo de 10 para el carrusel
        ->get();

    // 3. Traer todos los productos para el Catálogo General
    $allProducts = Product::with(['images', 'category'])
        ->where('is_active', true)
        ->latest()
        ->get();

    // 4. Mandamos las variables a la vista
    return view('welcome', compact('siteContent', 'featuredProducts', 'allProducts'));
})->name('home');
