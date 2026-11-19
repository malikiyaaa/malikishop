<?php

namespace App\Filament\Resources;

use BackedEnum;

use App\Filament\Resources\PembelianResource\Pages;
use App\Models\Pembelian;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            TextInput::make('id_pembelian')
                ->required()->unique(ignoreRecord: true)->label('ID Pembelian'),
            Select::make('user_id')
                ->relationship('user', 'name')->required()->label('Customer'),
            Select::make('kode_produk')
                ->relationship('produk', 'nama_produk')
                ->required()->label('Sparepart'),
            TextInput::make('jumlah')->required()->integer()->label('Jumlah'),
            TextInput::make('total_bayar')->required()->numeric()->label('Total Bayar'),
            DateTimePicker::make('tanggal_transaksi')->required(),
            Select::make('status')->options([
                'Verifikasi' => 'Verifikasi',
                'Proses'     => 'Proses',
                'Kirim'      => 'Kirim',
                'Sampai'     => 'Sampai',
                'Selesai'    => 'Selesai',
            ])->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id_pembelian')->searchable(),
            TextColumn::make('user.name')->label('Customer'),
            TextColumn::make('produk.nama_produk')->label('Sparepart'),
            TextColumn::make('jumlah'),
            TextColumn::make('total_bayar')->money('IDR'),
            TextColumn::make('tanggal_transaksi')->dateTime(),
            // Filament v5: gunakan ->badge() bukan BadgeColumn
            TextColumn::make('status')->badge()
                ->color(fn(string $state) => match($state) {
                    'Verifikasi' => 'warning',
                    'Proses'     => 'info',
                    'Kirim'      => 'primary',
                    'Sampai'     => 'success',
                    'Selesai'    => 'success',
                    default      => 'gray',
                }),
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
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}
