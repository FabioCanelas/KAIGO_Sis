<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-bold">Control de Caja</h2>
                @if($this->getActiveSession())
                    <p class="text-sm text-success-600">Sesión Abierta - Caja: {{\App\Models\CashRegister::find($this->getActiveSession()->cash_register_id)?->name}}</p>
                    <p class="text-xs text-gray-500">Monto Inicial: Bs. {{
number_format($this->getActiveSession()->opening_balance, 2)}}</p>
                @else
                    <p class="text-sm text-danger-600">Caja Cerrada. Debes abrir caja para registrar ventas.</p>
                @endif
            </div>
            
            <div>
                @if($this->getActiveSession())
                    {{ $this->closeSessionAction }}
                @else
                    {{ $this->openSessionAction }}
                @endif
            </div>
        </div>
        <x-filament-actions::modals />
    </x-filament::section>
</x-filament-widgets::widget>