<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Ubah customer_id menjadi dropdown berdasarkan relasi
            Forms\Components\Select::make('customer_id')
                ->label('Customer')
                ->relationship('customer', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\TextInput::make('invoice_number')
                ->required()
                ->maxLength(255),

            Forms\Components\DatePicker::make('invoice_date')
                ->required(),

            Forms\Components\TextInput::make('total_amount')
                ->required()
                ->numeric(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            // Menampilkan nama customer, bukan ID-nya
            Tables\Columns\TextColumn::make('customer.name')
                ->label('Customer')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('invoice_number')
                ->searchable(),

            Tables\Columns\TextColumn::make('invoice_date')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('total_amount')
                ->numeric()
                ->sortable(),

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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
