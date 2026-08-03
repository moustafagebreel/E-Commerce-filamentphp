<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopSellingProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Top Selling Products';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::withCount('order_items')
                    ->where('is_active', true)
                    ->orderByDesc('order_items_count')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->label('Image')
                    ->getStateUsing(fn ($record) => is_array($record->images) && count($record->images) > 0
                        ? url('storage/' . $record->images[0])
                        : null
                    )
                    ->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('price')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('order_items_count')->label('Orders')->sortable(),
                Tables\Columns\IconColumn::make('in_stock')->boolean()->label('In Stock'),
            ]);
    }
}
