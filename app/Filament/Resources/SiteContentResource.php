<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteContentResource\Pages;
use App\Filament\Resources\SiteContentResource\RelationManagers;
use App\Models\SiteContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteContentResource extends Resource
{
    protected static ?string $model = SiteContent::class;

    protected static ?string $modelLabel = 'Contenido';
    protected static ?string $pluralModelLabel = 'Contenidos';
    protected static ?string $navigationLabel = 'Sitio Web';


    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('section')
                    ->label('Sección')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('setting_key')
                    ->label('Clave (Variable)')
                    ->required()
                    ->maxLength(100)
                    ->hidden(),
                Forms\Components\Textarea::make('setting_value')
                    ->label('Texto / Valor')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section')
                    ->label('Sección')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('setting_key')
                    ->label('Clave')
                    ->searchable(),
                Tables\Columns\TextColumn::make('setting_value')
                    ->label('Texto')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ãltima actualización')
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
            ])
            ->defaultGroup('section');
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
            'index' => Pages\ListSiteContents::route('/'),
            'create' => Pages\CreateSiteContent::route('/create'),
            'edit' => Pages\EditSiteContent::route('/{record}/edit'),
        ];
    }
    // Esto oculta el botón de crear nuevo
    public static function canCreate(): bool
    {
        return false;
    }
    // Esto oculta los botones de eliminar para que no rompan la web
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
