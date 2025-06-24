<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerfumeResource\Pages;
use App\Filament\Resources\PerfumeResource\RelationManagers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Perfume;
use App\Models\RoomPerfume;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;

class PerfumeResource extends Resource
{
    protected static ?string $model = Perfume::class;

    protected static ?string $navigationGroup = 'Products';

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $set) {
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Perfume::class, 'slug', ignoreRecord: true)
                            ->disabled(),
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->options(function () {
                                return Category::where('active', true)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('brand_id')
                            ->label('Brand')
                            ->options(function () {
                                return Brand::where('active', true)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->required()
                            ->searchable(),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing & Inventory')
                    ->schema([
                        Forms\Components\TextInput::make('price_old')
                            ->numeric()
                            ->default(0)
                            ->prefix('RON')
                            ->reactive(),

                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('RON')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $currentPrice = $get('price');
                                $currentPriceOld = $get('price_old');

                                if ($currentPriceOld == 0) {
                                    $set('price_old', $currentPrice);
                                }
                                elseif ($currentPrice > $currentPriceOld) {
                                    $set('price_old', $currentPrice);
                                }
                            }),
                        Forms\Components\TextInput::make('stock')
                            ->numeric()
                            ->required()
                            ->prefix('BUC'),
                        Forms\Components\TextInput::make('size')
                            ->required()
                            ->prefix('ML'),
                    ])->columns(4),

                Forms\Components\Section::make('Fragrance Details')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TagsInput::make('top_notes')
                                    ->label('Note de vârf')
                                    ->placeholder('Adaugă note de vârf')
                                    ->separator(',')
                                    ->suggestions(['Bergamot', 'Lemon', 'Orange', 'Grapefruit'])
                                    ->nullable(),

                                Forms\Components\TagsInput::make('middle_notes')
                                    ->label('Note de mijloc')
                                    ->placeholder('Adaugă note de mijloc')
                                    ->separator(',')
                                    ->suggestions(['Lavender', 'Rose', 'Jasmine', 'Cardamom'])
                                    ->nullable(),

                                Forms\Components\TagsInput::make('base_notes')
                                    ->label('Note de bază')
                                    ->placeholder('Adaugă note de bază')
                                    ->separator(',')
                                    ->suggestions(['Cedarwood', 'Sandalwood', 'Musk', 'Amber'])
                                    ->nullable(),
                            ]),

                        Forms\Components\TextInput::make('concentration')->required()->label('Concentration')->columnSpan(3),
                    ]),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('active')
                            ->required()
                            ->default(true),
                        Forms\Components\TextInput::make('price_id')
                            ->label('Stripe Price ID')
                            ->required(),
                    ])->columns(2),

               Forms\Components\Section::make('Images')
                   ->schema([
                       Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                           ->label('Perfume Images')
                           ->multiple()
                           ->maxFiles(5)
                           ->collection('images')
                           ->columns(1),
                   ]),
//                 Forms\Components\Section::make('Images')
//                     ->schema([
//                         Forms\Components\FileUpload::make('images')
//                             ->multiple()
//                             ->image()
//                             ->imageEditor()
//                             ->openable()
//                             ->downloadable()
//                             ->reorderable()
//                             ->collection('images')
//                             ->preserveFilenames()
//                             ->columnSpanFull(),
//                     ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('main_image_url')
                    ->label('Image')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                TextColumn::make('brand.name')
                    ->label('Brand')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->money('RON')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),
                BooleanColumn::make('active')
                    ->label('Active')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Search by name')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['name'],
                            fn(Builder $query, $name) => $query->where('name', 'like', "%{$name}%")
                        );
                    }),

                SelectFilter::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('price')
                    ->form([
                        Forms\Components\TextInput::make('min_price')
                            ->label('Min Price')
                            ->numeric(),
                        Forms\Components\TextInput::make('max_price')
                            ->label('Max Price')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_price'],
                                fn(Builder $query, $minPrice) => $query->where('price', '>=', $minPrice)
                            )
                            ->when(
                                $data['max_price'],
                                fn(Builder $query, $maxPrice) => $query->where('price', '<=', $maxPrice)
                            );
                    }),

                Filter::make('stock')
                    ->form([
                        Forms\Components\TextInput::make('min_stock')
                            ->label('Min Stock')
                            ->numeric(),
                        Forms\Components\TextInput::make('max_stock')
                            ->label('Max Stock')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_stock'],
                                fn(Builder $query, $minStock) => $query->where('stock', '>=', $minStock)
                            )
                            ->when(
                                $data['max_stock'],
                                fn(Builder $query, $maxStock) => $query->where('stock', '<=', $maxStock)
                            );
                    }),

                SelectFilter::make('active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),

                Filter::make('has_media')
                    ->label('Has Image')
                    ->query(fn(Builder $query): Builder => $query->whereHas('media')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            RelationManagers\BrandRelationManager::class,
            RelationManagers\CategoryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPerfumes::route('/'),
            'create' => Pages\CreatePerfume::route('/create'),
            'edit' => Pages\EditPerfume::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('active', true)->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Number of active room perfumes';
    }
}
