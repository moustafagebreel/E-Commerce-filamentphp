<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlashSaleResource\Pages;
use App\Models\FlashSale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FlashSaleResource extends Resource
{
    protected static ?string $model = FlashSale::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationGroup = 'Marketing';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Flash Sale Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('discount_percentage')
                            ->numeric()
                            ->suffix('%')
                            ->default(15)
                            ->required(),
                        Forms\Components\DateTimePicker::make('start_time')
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_time')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Deal Products')
                    ->schema([
                        Forms\Components\Select::make('products')
                            ->relationship('products', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('discount_percentage')->suffix('%')->sortable(),
                Tables\Columns\TextColumn::make('start_time')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('end_time')->dateTime()->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('products_count')->counts('products')->label('Products Count'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFlashSales::route('/'),
            'create' => Pages\CreateFlashSale::route('/create'),
            'edit' => Pages\EditFlashSale::route('/{record}/edit'),
        ];
    }
}
