<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\OrderResource\Pages;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //group
                Group::make()->schema([
                    Section::make('order information')
                        ->schema([
                            Select::make('user_id')
                                ->options(User::pluck('name', 'id'))
                                ->label('customer')
                                ->required()
                                ->preload()
                                ->live()
                                ->searchable()
                                ->placeholder('Select a user'),

                            Select::make('payment_method')
                                ->options([

                                    'cash_on_delivery' => 'cash on delivery',
                                    'paypal' => 'paypal',
                                    'stripe' => 'stripe',
                                    'razorpay' => 'razorpay',
                                    'paystack' => 'paystack',
                                    'flutterwave' => 'flutterwave',
                                    'voguepay' => 'voguepay',
                                ])
                                ->label('payment method')
                                ->required()
                                ->placeholder('Select a payment method'),

                            Select::make('payment_status')
                                ->options([
                                    'paid' => 'Paid',
                                    'unpaid' => 'Unpaid',

                                ])
                                ->label('payment status')
                                ->required()
                                ->placeholder('Select a payment status'),

                            ToggleButtons::make('status')
                                ->options([
                                    'new' => 'new',
                                    'processing' => 'processing',
                                    'shipped' => 'shipped',
                                    'delivered' => 'delivered',
                                    'cancelled' => 'cancelled',

                                ])
                                ->colors([
                                    'new' => 'info',
                                    'processing' => 'warning',
                                    'shipped' => 'success',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                ])
                                ->icons([
                                    'new' => 'heroicon-o-sparkles',
                                    'processing' => 'heroicon-m-arrow-path',
                                    'shipped' => 'heroicon-o-truck',
                                    'delivered' => 'heroicon-o-check-badge',
                                    'cancelled' => 'heroicon-o-x-circle',

                                ])
                                ->label('order status')
                                ->required()
                                ->default('new')
                                ->inline(),

                            Select::make('currency')
                                ->options([
                                    'USD' => 'USD',
                                    'EUR' => 'EUR',

                                ])
                                ->label('currency')
                                ->required()
                                ->default('USD'),

                            Select::make('shipping_method')
                                ->options([
                                    'flat_rate' => 'flat rate',
                                    'free_shipping' => 'free shipping',
                                    'local_pickup' => 'local pickup',
                                    'local_delivery' => 'local delivery',
                                    'fedex' => 'fedex',

                                    ])
                                    ->label('shipping method')
                                    ->required()
                                    ->default('flat_rate'),

                                    Textarea::make('notes')
                                    ->label('notes')
                                    ->placeholder('Enter notes here')
                                    ->columnSpanFull(),


                                    

                        ])->columns(2),

                        Section::make('order items')->schema([
                        Repeater::make('items')
                        ->relationship()
                        ->schema([
                                Select::make('product_id')
                                ->relationship('product', 'name')
                                ->required()
                                ->preload()
                                ->live()
                                ->searchable()
                                ->placeholder('Select a product')

                                ->distinct()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->reactive()
                                ->afterStateUpdated(fn ($state, $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                                ->afterStateUpdated(fn ($state, $set) => $set('total_amount', Product::find($state)?->price ?? 0))
                                ,

                                TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->reactive()
                                ->live()
                                ->afterStateUpdated(function ($state, $set, $get)
                                 {
                                    $unit_amount = $get('unit_amount');
                                    if ($unit_amount) {
                                        $set('total_amount', $unit_amount * $state);
                                    }
                                })
                                ->placeholder('Select a quantity'),

                                TextInput::make('unit_amount')
                                ->numeric()
                                
                                ->disabled()
                                ->dehydrated(),

                                TextInput::make('total_amount')
                                ->numeric()
                                ->required(),                                
                        ])->columns(4),
                        Placeholder::make('grand_total_placeholder')
                        ->label('Grand Total')
                        ->content(function (Get $get, Set $set) {
                            $total = 0;
                            if (!$repeaters = $get('items')) {
                                return $total;
                            }
                    
                            foreach ($repeaters as $key => $repeater) {
                                $total += $get("items.{$key}.total_amount");
                            }
                            $set('grand_total', $total);
                            return Number::currency($total, 'INR');
                            }),
                        
                            Hidden::make('grand_total')
                            ->default(0)
                        
                        
                        
                        ]),

                ])->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('grand total')
                    ->searchable()
                    ->sortable(),

                    SelectColumn::make('status')
                    ->options([
                        'new' => 'new',
                        'processing' => 'processing',
                        'shipped' => 'shipped',
                        'deliverd' => 'deliverd',
                        'canceled' => 'canceled',
                    ])
                    ->label('order status')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('payment method')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('payment status')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('currency')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('shipping_method')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('notes')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
