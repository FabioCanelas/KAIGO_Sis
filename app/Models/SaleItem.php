<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected \ = [];

    public function sale()
    {
        return \->belongsTo(Sale::class);
    }

    public function product()
    {
        return \->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::creating(function (\) {
            \ = \->product;
            if (\) {
                \->unit_cost = \->average_cost;
            }
        });
    }
}
