<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingZoneResource\Pages;
use App\Models\ShippingZone;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShippingZoneResource extends Resource
{
    protected static ?string $model = ShippingZone::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('region_code')
                    ->maxLength(10),
                Forms\Components\TextInput::make('base_rate')
                    ->numeric()
                    ->prefix('$')
                    ->default(15.00)
                    ->required(),
                Forms\Components\TextInput::make('free_shipping_threshold')
                    ->numeric()
                    ->prefix('$')
                    ->placeholder('e.g. 100.00'),
                Forms\Components\TextInput::make('estimated_days')
                    ->numeric()
                    ->suffix('days')
                    ->default(3)
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('region_code')->placeholder('-'),
                Tables\Columns\TextColumn::make('base_rate')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('free_shipping_threshold')->money('USD')->placeholder('No Free Limit'),
                Tables\Columns\TextColumn::make('estimated_days')->suffix(' days')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShippingZones::route('/'),
        ];
    }
}
