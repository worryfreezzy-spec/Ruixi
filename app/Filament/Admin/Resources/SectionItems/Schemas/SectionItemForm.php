<?php

namespace App\Filament\Admin\Resources\SectionItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SectionItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('标题')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('icon')
                    ->label('图标')
                    ->disk('public')
                    ->directory('section-icons')
                    ->image()
                    ->required(),
            ]);
    }
}
