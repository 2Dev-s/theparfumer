<?php
namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class AddresesRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';
    protected static ?string $title = 'Addresses';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->options([
                    'company' => 'Company',
                    'personal' => 'Personal',
                ])
                ->default('pending')
                ->required(),
            Forms\Components\TextInput::make('company_name')->maxLength(255),

            Forms\Components\TextInput::make('tax_id')->maxLength(255),
            Forms\Components\TextInput::make('street')->required()->maxLength(255),
            Forms\Components\TextInput::make('city')->required()->maxLength(255),
            Forms\Components\TextInput::make('state')->maxLength(255),
            Forms\Components\TextInput::make('postal_code')->required()->maxLength(255),
            Forms\Components\TextInput::make('country')->required()->maxLength(255),
            Forms\Components\TextInput::make('phone')->tel()->maxLength(255),
            Forms\Components\Toggle::make('is_default')->label('Default Address'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_address')
            ->columns([
                Tables\Columns\TextColumn::make('type')->label('Type')->sortable(),
                Tables\Columns\TextColumn::make('full_address')->label('Address')->limit(60),
                Tables\Columns\IconColumn::make('is_default')->boolean()->label('Default'),
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

