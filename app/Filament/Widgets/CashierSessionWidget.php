<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\CashRegister;
use App\Models\CashRegisterSession;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class CashierSessionWidget extends Widget implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static string $view = 'filament.widgets.cashier-session-widget';
    protected int | string | array $columnSpan = 'full';

    public function getActiveSession()
    {
        return CashRegisterSession::where('user_id', auth()->id())
            ->where('status', 'open')
            ->first();
    }

    public function openSessionAction(): Action
    {
        return Action::make('openSession')
            ->label('Abrir Caja')
            ->color('success')
            ->icon('heroicon-o-lock-open')
            ->form([
                Forms\Components\Select::make('cash_register_id')
                    ->label('Caja')
                    ->options(CashRegister::where('is_active', true)->pluck('name', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('opening_balance')
                    ->label('Monto Inicial')
                    ->numeric()
                    ->required()
                    ->default(0),
            ])
            ->action(function (array $data) {
                if ($this->getActiveSession()) {
                    Notification::make()->title('Ya tienes una caja abierta.')->danger()->send();
                    return;
                }
                CashRegisterSession::create([
                    'cash_register_id' => $data['cash_register_id'],
                    'user_id' => auth()->id(),
                    'opening_balance' => $data['opening_balance'],
                    'status' => 'open',
                    'opened_at' => now(),
                ]);
                Notification::make()->title('Caja abierta exitosamente.')->success()->send();
            });
    }

    public function closeSessionAction(): Action
    {
        return Action::make('closeSession')
            ->label('Cerrar Caja')
            ->color('danger')
            ->icon('heroicon-o-lock-closed')
            ->requiresConfirmation()
            ->form([
                Forms\Components\TextInput::make('closing_balance')
                    ->label('Monto Final en Caja (Efectivo real)')
                    ->numeric()
                    ->required(),
            ])
            ->action(function (array $data) {
                $session = $this->getActiveSession();
                if (!$session) return;
                
                $session->update([
                    'status' => 'closed',
                    'closed_at' => now(),
                    'closing_balance' => $data['closing_balance'],
                ]);
                Notification::make()->title('Caja cerrada exitosamente.')->success()->send();
            });
    }
}