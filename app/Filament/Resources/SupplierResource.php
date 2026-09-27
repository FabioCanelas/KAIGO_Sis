<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $modelLabel = 'Proveedor';
    protected static ?string $pluralModelLabel = 'Proveedores';
    protected static ?string $navigationLabel = 'Proveedores';


    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

        public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nombre de la Empresa')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_name')->label('Nombre del Contacto')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')->label('Teléfono')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')->label('Correo Electrónico')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Textarea::make('address')->label('Dirección')
                    ->columnSpanFull(),
            ]);
    }

        public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre de la Empresa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_name')->label('Nombre del Contacto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Correo Electrónico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
