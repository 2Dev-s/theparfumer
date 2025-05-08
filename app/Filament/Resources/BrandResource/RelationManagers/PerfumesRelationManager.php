<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PerfumesRelationManager extends RelationManager
{
    protected static string $relationship = 'parfums';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('brand_id')
                    ->label('Brand')
                    ->options(function () {
                        return Brand::where('active', true)
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->required(),
                Forms\Components\TextInput::make('price')->numeric()->required(),
                Forms\Components\TextInput::make('stock')->numeric()->required(),
                Forms\Components\Textarea::make('description')->label('Description')->required()
                    ->columnSpan(2),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('name')->label('Name'),
                TextColumn::make('brand.name')->label('Brand'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('price')
                    ->label('Price')
                    ->formatStateUsing(fn($state) => $state . ' RON'),
                TextColumn::make('stock')->label('Stock'),
                BooleanColumn::make('active')->label('Active'),
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

                // Price range filter
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
