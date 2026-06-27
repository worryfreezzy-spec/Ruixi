<?php

namespace App\Filament\Admin\Resources\AboutStories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AboutStoryForm
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
                    ->label('正文')
                    ->rows(8)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('图片')
                    ->disk('public')
                    ->directory('about')
                    ->image(),
                TextInput::make('button_text')
                    ->label('按钮文字'),
                TextInput::make('button_url')
                    ->label('按钮链接'),
            ]);
    }
}
