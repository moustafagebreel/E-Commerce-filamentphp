<?php

namespace App\Filament\Widgets;

use App\Models\ProductReview;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestReviewsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ProductReview::query()->latest()->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->limit(25),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer'),
                Tables\Columns\TextColumn::make('rating')
                    ->badge()
                    ->color(fn (int $state): string => $state >= 4 ? 'success' : 'danger'),
                Tables\Columns\IconColumn::make('is_approved')
                    ->boolean(),
            ]);
    }
}
