<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('所属分类')
                    ->relationship('category', 'title'),
                TextInput::make('title')
                    ->label('标题')
                    ->required(),
                TextInput::make('slug')
                    ->label('路径标识')
                    ->required(),
                TextInput::make('short_title')
                    ->label('短标题'),
                Textarea::make('summary')
                    ->label('摘要')
                    ->columnSpanFull(),
                FileUpload::make('hero_image')
                    ->label('横幅图片')
                    ->disk('public')
                    ->directory('services')
                    ->image(),
                FileUpload::make('thumbnail')
                    ->label('缩略图')
                    ->disk('public')
                    ->directory('services')
                    ->image(),
                TextInput::make('intro_title')
                    ->label('介绍标题'),
                Textarea::make('intro_description')
                    ->label('介绍说明')
                    ->columnSpanFull(),
                TextInput::make('benefits_title')
                    ->label('优势标题'),
                Toggle::make('is_featured')
                    ->label('首页推荐')
                    ->required(),
                TextInput::make('sort_order')
                    ->label('排序')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('启用')
                    ->required(),
            ]);
    }
}
