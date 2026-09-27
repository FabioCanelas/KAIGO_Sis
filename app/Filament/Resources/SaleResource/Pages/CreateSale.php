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
        protected function mutateFormDataBeforeCreate(array $data): array
    {
        $session = \App\Models\CashRegisterSession::where('user_id', auth()->id())
            ->where('status', 'open')
            ->first();
            
        if (!$session) {
            \Filament\Notifications\Notification::make()
                ->title('Error: No tienes una caja abierta. Por favor, abre una sesión primero.')
                ->danger()
                ->send();
            $this->halt();
        }
        
        $data['cash_register_session_id'] = $session->id;
        return $data;
    }

    protected function afterCreate(): void
    {
        $sale = $this->record; 
        
        $total = $sale->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        $sale->total_amount = $total;
        $sale->save();

        // Deduct stock and log movement
        foreach ($sale->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();

                \App\Models\StockMovement::create([
                    'product_id' => $item->product_id,
                    'type' => 'out',
                    'quantity' => $item->quantity,
                    'reason' => 'Venta #' . $sale->id,
                    'reference_type' => get_class($sale),
                    'reference_id' => $sale->id,
                ]);
            }
        }
    }

}
