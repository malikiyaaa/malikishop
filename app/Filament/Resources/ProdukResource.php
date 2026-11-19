<?php

namespace App\Filament\Resources;

use BackedEnum;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\Produk;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationLabel = 'Sparepart';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('kode_produk')
                ->required()->unique(ignoreRecord: true)->label('Kode Produk'),
            TextInput::make('nama_produk')->required()->label('Nama Sparepart'),
            TextInput::make('tipe_kendaraan')->required()->label('Tipe Kendaraan'),
            Select::make('kategori_id')
                ->relationship('kategori', 'nama_kategori')
                ->required()->label('Kategori'),
            Select::make('brand_id')
                ->relationship('brand', 'nama_brand')
                ->required()->label('Brand'),
            TextInput::make('harga')->required()->numeric()->label('Harga'),
            TextInput::make('stok')->required()->integer()->label('Stok'),
            FileUpload::make('gambar')->image()->label('Foto Produk'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('kode_produk')->sortable()->searchable(),
            TextColumn::make('nama_produk')->sortable()->searchable(),
            TextColumn::make('tipe_kendaraan')->sortable(),
            TextColumn::make('kategori.nama_kategori')->label('Kategori'),
            TextColumn::make('brand.nama_brand')->label('Brand'),
            TextColumn::make('harga')->money('IDR'),
            TextColumn::make('stok'),
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
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}
