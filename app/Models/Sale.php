<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['customer_name', 'total_amount', 'payment_method'];

    // Una venta tiene muchos ítems
    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
