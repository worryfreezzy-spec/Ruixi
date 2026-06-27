<?php

namespace App\Filament\Admin\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BannerForm
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
                    ->label('图片上传')
                    ->image()
                    ->disk('public')
                    ->directory('banners')
                    ->required(),
                TextInput::make('link_url')
                    ->label('跳转链接')
                    ->maxLength(255),
            ]);
    }
}
