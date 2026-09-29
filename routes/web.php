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

    // Traer las marcas de la base de datos
    $brands = \App\Models\Brand::all();

    // 4. Mandamos las variables a la vista
    return view('welcome', compact('siteContent', 'featuredProducts', 'allProducts', 'brands'));
})->name('home');

Route::get('/catalogo', function (\Illuminate\Http\Request $request) {
    $siteContent = SiteContent::all()->pluck('setting_value', 'setting_key')->toArray();
    
    $query = Product::with(['images', 'category'])->where('is_active', true);
    
    $currentCategory = null;
    if ($request->has('category')) {
        $query->where('category_id', $request->query('category'));
        $currentCategory = \App\Models\Category::find($request->query('category'));
    }

    $allProducts = $query->latest()->get();

    // Traer categorías para el Sidebar
    $categories = \App\Models\Category::withCount('products')->get();

    return view('catalogo', compact('siteContent', 'allProducts', 'categories', 'currentCategory'));
})->name('catalogo');


use Illuminate\Support\Facades\Artisan;

Route::get('/reset-db-now', function () {
    try {
        $output = '';
        Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        $output .= 'MIGRATE: ' . Artisan::output() . '<br>';
        Artisan::call('shield:generate', ['--all' => true, '--panel' => 'admin']);
        $output .= 'SHIELD GEN: ' . Artisan::output() . '<br>';
        Artisan::call('shield:super-admin', ['--user' => 1, '--panel' => 'admin']);
        $output .= 'SUPER ADMIN: ' . Artisan::output() . '<br>';
        return 'Base de datos reseteada con exito!<br>' . $output;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage() . '<br>OUTPUT SO FAR:<br>' . ($output ?? '');
    }
});
