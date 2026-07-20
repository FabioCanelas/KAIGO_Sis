<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price'];

    // Un ítem pertenece a una venta y a un producto específico
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
        // Este "Evento" se dispara automáticamente cada vez que se guarda una venta
    protected static function booted()
    {
        static::created(function ($item) {
            $producto = $item->product;
            
            if ($producto) {
                // Le restamos al stock actual, la cantidad que se acaba de vender
                $producto->stock = $producto->stock - $item->quantity;
                $producto->save();
            }
        });
    }

}
