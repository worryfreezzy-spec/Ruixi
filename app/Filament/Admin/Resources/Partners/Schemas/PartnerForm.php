<?php

namespace App\Filament\Admin\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('标题')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('logo')
                    ->label('图片')
                    ->disk('public')
                    ->directory('partners')
                    ->image()
                    ->required(),
                TextInput::make('url')
                    ->label('链接')
                    ->maxLength(255),
            ]);
    }
}
