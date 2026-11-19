<?php

namespace App\Filament\Resources;

use BackedEnum;

use App\Filament\Resources\KategoriResource\Pages;
use App\Models\Kategori;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KategoriResource extends Resource
{
    protected static ?string $model = Kategori::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Kategori';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('id')
                ->required()->unique(ignoreRecord: true)->label('ID Kategori'),
            TextInput::make('nama_kategori')->required()->label('Nama Kategori'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable()->searchable()->label('ID'),
            TextColumn::make('nama_kategori')->sortable()->searchable(),
        ])->actions([
            EditAction::make(),
            DeleteAction::make(),
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
            'index' => Pages\ListKategoris::route('/'),
            'create' => Pages\CreateKategori::route('/create'),
            'edit' => Pages\EditKategori::route('/{record}/edit'),
        ];
    }
}
