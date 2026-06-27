<?php

namespace App\Filament\Admin\Resources\ServiceCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('标题')
                    ->required(),
                TextInput::make('slug')
                    ->label('路径标识')
                    ->required(),
                TextInput::make('type')
                    ->label('类型')
                    ->required()
                    ->default('other'),
                TextInput::make('hero_title')
                    ->label('横幅标题'),
                FileUpload::make('hero_image')
                    ->label('横幅图片')
                    ->disk('public')
                    ->directory('service-categories')
                    ->image(),
                TextInput::make('intro_title')
                    ->label('介绍标题'),
                Textarea::make('intro_description')
                    ->label('介绍说明')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('symptom_title')
                    ->label('症状标题'),
                Textarea::make('symptom_description')
                    ->label('症状说明')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('symptom_image')
                    ->label('症状图片')
                    ->disk('public')
                    ->directory('service-categories')
                    ->image(),
                Textarea::make('symptoms')
                    ->label('症状列表')
                    ->rows(6)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('说明')
                    ->columnSpanFull(),
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
