<?php

namespace App\Filament\Admin\Resources\OptimaxAdvantages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OptimaxAdvantageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('标题')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('说明')
                    ->rows(8)
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('启用')
                    ->default(true),
            ]);
    }
}
