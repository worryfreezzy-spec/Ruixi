<?php

namespace App\Filament\Admin\Resources\Awards\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AwardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('标题')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image')
                    ->label('图片')
                    ->disk('public')
                    ->directory('awards')
                    ->image()
                    ->required(),
                TextInput::make('link_url')
                    ->label('链接')
                    ->maxLength(255),
            ]);
    }
}
