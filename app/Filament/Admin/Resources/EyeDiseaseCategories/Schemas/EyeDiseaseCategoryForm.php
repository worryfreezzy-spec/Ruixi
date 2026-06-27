<?php

namespace App\Filament\Admin\Resources\EyeDiseaseCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EyeDiseaseCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('列表页基础信息')
                    ->schema([
                        TextInput::make('title')
                            ->label('页面名称')
                            ->required(),
                        TextInput::make('slug')
                            ->label('路径标识')
                            ->required(),
                        Hidden::make('type')
                            ->default('eye_disease'),
                        TextInput::make('sort_order')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('启用')
                            ->default(true),
                    ])
                    ->columns(2),
                Section::make('横幅设置')
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('横幅标题'),
                        FileUpload::make('hero_image')
                            ->label('横幅图片')
                            ->disk('public')
                            ->directory('service-categories')
                            ->image(),
                    ])
                    ->columns(2),
                Section::make('页面介绍')
                    ->schema([
                        TextInput::make('intro_title')
                            ->label('介绍标题'),
                        Textarea::make('intro_description')
                            ->label('介绍说明')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('SEO说明')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
