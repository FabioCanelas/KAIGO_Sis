<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;
use App\Models\Purchase;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $modelLabel = 'Compra';
    protected static ?string $pluralModelLabel = 'Compras';
    protected static ?string $navigationLabel = 'Ingreso de Mercadería';


    protected static ?string $navigationIcon = 'heroicon-o-truck';

        public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('supplier_id')->label('Proveedor')->searchable()->preload()
                        ->relationship('supplier', 'name')
                        ->required(),
                    Forms\Components\TextInput::make('invoice_number')->label('Número de Factura / Recibo')
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('purchase_date')->label('Fecha de Compra')
                        ->required()
                        ->default(now()),
                    Forms\Components\Textarea::make('notes')->label('Notas / Observaciones')
                        ->columnSpanFull(),
                ])->columnSpan(1),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Repeater::make('purchaseItems')->label('Detalle de Productos')
                        ->relationship()
                        ->schema([
                            Forms\Components\Select::make('product_id')
                                ->label('Producto')
                                ->searchable(['name', 'code'])
                                ->preload()
->allowHtml()
                                    ->getOptionLabelFromRecordUsing(function (\App\Models\Product $record) {
                                        $name = $record->code ? "{$record->code} - {$record->name}" : $record->name;
                                        $image = $record->images->where('is_primary', true)->first() ?? $record->images->first();
                                        if ($image && $image->image_path) {
                                            $url = \Illuminate\Support\Facades\Storage::url($image->image_path);
                                            return "<div class='flex items-center gap-3'>
                                                        <img src='{$url}' alt='{$record->name}' style='width: 32px; height: 32px; object-fit: cover; border-radius: 50%; border: 1px solid #ccc;'>
                                                        <span>{$name}</span>
                                                    </div>";
                                        }
                                        return "<div class='flex items-center gap-3'>
                                                    <div style='width: 32px; height: 32px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #aaa; border: 1px solid #ccc;'>N/A</div>
                                                    <span>{$name}</span>
                                                </div>";
                                    })
                                ->relationship('product', 'name')
                                ->required()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                            Forms\Components\TextInput::make('quantity')->label('Cantidad')
                                ->numeric()
                                ->required()
                                ->minValue(1),
                            Forms\Components\TextInput::make('unit_cost')->label('Costo Unitario')
                                ->numeric()
                                ->required()
                                ->minValue(0),
                        ])
                        ->columns(3)
                        ->addActionLabel('Agregar Producto')
                ])->columnSpan(2),
            ])->columns(3);
    }

        public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoice_number')->label('Número de Factura / Recibo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('purchase_date')->label('Fecha de Compra')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
