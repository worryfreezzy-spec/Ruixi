<?php

namespace App\Filament\Admin\Resources\ContactForms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactFormForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('名称')
                    ->required(),
                Toggle::make('is_active')
                    ->label('启用')
                    ->required(),
            ]);
    }
}
