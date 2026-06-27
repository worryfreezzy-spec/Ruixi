<?php

namespace App\Filament\Admin\Resources\Menus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('名称')
                    ->required(),
                TextInput::make('location')
                    ->label('位置')
                    ->required()
                    ->default('header'),
                Toggle::make('is_active')
                    ->label('启用')
                    ->required(),
            ]);
    }
}
