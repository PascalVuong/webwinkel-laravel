<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->helperText('The name of the category')
                    ->placeholder('For example: Assault Rifles')
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('URL-name (slug)')
                    ->helperText('Will be used in the URL, for example: "assault-rifles" -> /categories/assault-rifles')
                    ->placeholder('For example: assault-rifles')
                    ->required()
                    ->maxLength(255)
            ]);
    }
}
