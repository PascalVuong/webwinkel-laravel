<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state, string $context) {
                        if ($context === 'edit') {
                            return;
                        }

                        $set('slug', Str::slug($state ?? ''));
                    }),

                TextInput::make('slug')
                    ->label('URL-name (slug)')
                    ->helperText('Will be used in the URL, for example: "AK-47" -> /producten/ak-47')
                    ->rules(['alpha_dash'])
                    ->unique(ignoreRecord: true)
                    ->maxLength(191)
                    ->required(),

                TextInput::make('price')
                    ->label('Price (€)')
                    ->numeric()
                    ->minValue(0)
                    ->step('0.01')
                    ->prefix('€')
                    ->required(),

                Textarea::make('description')
                    ->nullable()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->required(),
            ]);
    }
}
