<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseItem extends Model
{
    protected $fillable = ['purchase_id', 'product_id', 'quantity', 'unit_cost'];
    public $timestamps = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }
    protected static function booted()
    {
        static::created(function ($item) {
            $product = $item->product;
            if ($product) {
                $oldTotalValue = $product->stock * $product->average_cost;
                $addedValue = $item->quantity * $item->unit_cost;
                
                $newStock = $product->stock + $item->quantity;
                $newAverageCost = $newStock > 0 ? ($oldTotalValue + $addedValue) / $newStock : 0;
                
                $product->stock = $newStock;
                $product->average_cost = $newAverageCost;
                $product->save();
            }
        });
    }
}

