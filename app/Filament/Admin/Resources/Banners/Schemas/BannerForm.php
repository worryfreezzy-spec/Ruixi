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
                    ->label('电脑端图片')
                    ->image()
                    ->disk('public')
                    ->directory('banners')
                    ->required(),
                FileUpload::make('mobile_image')
                    ->label('手机端图片')
                    ->image()
                    ->disk('public')
                    ->directory('banners/mobile'),
                TextInput::make('link_url')
                    ->label('跳转链接')
                    ->maxLength(255),
            ]);
    }
}
