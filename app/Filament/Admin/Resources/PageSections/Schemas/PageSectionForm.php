<?php

namespace App\Filament\Admin\Resources\PageSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('标题'),
                TextInput::make('subtitle')
                    ->label('副标题'),
                Textarea::make('description')
                    ->label('说明')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('图片')
                    ->disk('public')
                    ->directory('page-sections')
                    ->image(),
                FileUpload::make('background_image')
                    ->label('背景图片')
                    ->disk('public')
                    ->directory('page-section-backgrounds')
                    ->image(),
                TextInput::make('button_text')
                    ->label('按钮文字'),
                TextInput::make('button_url')
                    ->label('按钮链接'),
            ]);
    }
}
