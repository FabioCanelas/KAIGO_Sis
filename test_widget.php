<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$widget = app(App\Filament\Widgets\ProfitOverview::class);
$reflection = new ReflectionClass($widget);
$method = $reflection->getMethod('getStats');
$method->setAccessible(true);
$stats = $method->invoke($widget);
print_r($stats);
echo "SUCCESS\n";
