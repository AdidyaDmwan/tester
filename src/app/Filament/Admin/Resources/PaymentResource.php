<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('customer_id')
                ->label('Customer')
                ->relationship('customer', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\Select::make('invoice_id')
                ->label('Invoice')
                ->relationship('invoice', 'invoice_number')
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\TextInput::make('amount')
                ->required()
                ->numeric(),

            Forms\Components\DatePicker::make('payment_date')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('customer.name')
                ->label('Customer')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('invoice.invoice_number')
                ->label('Invoice')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('amount')
                ->numeric()
                ->sortable(),

            Tables\Columns\TextColumn::make('payment_date')
                ->date()
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
