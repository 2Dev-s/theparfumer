<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerfumeResource\Pages;
use App\Filament\Resources\PerfumeResource\RelationManagers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Perfume;
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

class PerfumeResource extends Resource
{
    protected static ?string $model = Perfume::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'System Management';

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, $set) {
                        $set('slug', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(Perfume::class, 'slug', ignoreRecord: true)->disabled(),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(function () {
                        return Category::where('active', true)
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->required()->searchable(),
                Forms\Components\Select::make('brand_id')
                    ->label('Brand')
                    ->options(function () {
                        return Brand::where('active', true)
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->required()->searchable(),
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('price')->numeric()->required(),
                        Forms\Components\TextInput::make('stock')->numeric()->required(),
                        Forms\Components\TextInput::make('size')->integer()->required(),
                    ]),
                Forms\Components\Textarea::make('description')->label('Description')->required()
                    ->columnSpan(2),

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
                Forms\Components\TextInput::make('concentration')->required()->label('Concentration')->columnSpan(2),
                Forms\Components\Select::make('active')
                    ->options(['1' => 'Active', '0' => 'Inactive'])
                    ->default('1')
                    ->required(),
                Forms\Components\Select::make('sex')
                    ->options(['male' => 'Male', 'female' => 'Female', 'unisex' => 'Unisex'])
                    ->default('male')
                    ->required(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                    ->label('Parfum Images')
                    ->multiple()
                    ->maxFiles(5)
                    ->collection('images')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('brand.name')->label('Brand'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('price')
                    ->label('Price')
                    ->formatStateUsing(fn($state) => $state . ' RON'),
                TextColumn::make('stock')->label('Stock'),
                BooleanColumn::make('active')->label('Active'),
                TextColumn::make('sex')->label('Sex'),
                Tables\Columns\ImageColumn::make('media.first.url')
                    ->label('Preview')
                    ->getStateUsing(function ($record) {
                        return $record->getFirstMediaUrl('images');
                    }),
            ])
            ->filters([
                // Filter by name
                Filter::make('name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Search by name')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['name'],
                            fn (Builder $query, $name) => $query->where('name', 'like', "%{$name}%")
                        );
                    }),

                // Filter by brand
                SelectFilter::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),

                // Filter by description
                Filter::make('description')
                    ->form([
                        Forms\Components\TextInput::make('description')
                            ->label('Search in description')
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['description'],
                            fn (Builder $query, $description) => $query->where('description', 'like', "%{$description}%")
                        );
                    }),

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
                                fn (Builder $query, $minPrice) => $query->where('price', '>=', $minPrice)
                            )
                            ->when(
                                $data['max_price'],
                                fn (Builder $query, $maxPrice) => $query->where('price', '<=', $maxPrice)
                            );
                    }),

                // Stock filter
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
                                fn (Builder $query, $minStock) => $query->where('stock', '>=', $minStock)
                            )
                            ->when(
                                $data['max_stock'],
                                fn (Builder $query, $maxStock) => $query->where('stock', '<=', $maxStock)
                            );
                    }),

                // Active filter
                SelectFilter::make('active')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),

                // Sex filter (existing)
                SelectFilter::make('sex')
                    ->options([
                        'male' => 'Masculin',
                        'female' => 'Feminin',
                        'unisex' => 'Unisex',
                    ]),

                // Filter by media presence
                Filter::make('has_media')
                    ->label('Has Image')
                    ->query(fn (Builder $query): Builder => $query->whereHas('media')),
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
            RelationManagers\BrandRelationManager::class,
            RelationManagers\CategoryRelationManager::class
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
        return 'The number of parfumes active';
    }
}
