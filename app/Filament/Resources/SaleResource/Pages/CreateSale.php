<?php

namespace App\Filament\Resources\SaleResource\Pages;

use App\Filament\Resources\SaleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); 
    }

    // Esta función se ejecuta DESPUÉS de que la venta y los ítems ya se guardaron en la DB
    protected function afterCreate(): void
    {
        $sale = $this->record; 
        
        $total = $sale->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        $sale->total_amount = $total;
        $sale->save();
    }

}
