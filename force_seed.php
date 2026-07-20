<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    for ($i = 1; $i <= 10; $i++) {
        $category = \App\Models\Category::create([
            'name' => 'Categoria Prueba ' . $i,
            'slug' => 'categoria-prueba-' . $i,
        ]);

        for ($j = 1; $j <= 10; $j++) {
            \App\Models\Product::create([
                'category_id' => $category->id,
                'name' => 'Producto Prueba ' . $i . '-' . $j,
                'slug' => 'producto-prueba-' . $i . '-' . $j,
                'description' => 'Descripción de prueba',
                'price' => rand(10, 1000),
                'stock' => rand(1, 100),
                'is_active' => true,
                'is_featured' => false,
            ]);
        }
    }
    echo "INSERCION EXITOSA: " . \App\Models\Category::count() . " categorias en total.\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
