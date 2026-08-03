<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserWalletResource\Pages;
use App\Models\UserWallet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserWalletResource extends Resource
{
    protected static ?string $model = UserWallet::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Customers';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('balance')
                    ->numeric()
                    ->prefix('$')
                    ->default(0.00)
                    ->required(),
                Forms\Components\TextInput::make('points')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Customer')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('balance')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('points')->suffix(' PTS')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserWallets::route('/'),
        ];
    }
}
