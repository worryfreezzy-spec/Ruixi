<?php

namespace App\Filament\Admin\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parent_id')
                    ->label('上级')
                    ->relationship('parent', 'title'),
                TextInput::make('title')
                    ->label('标题')
                    ->required(),
                TextInput::make('slug')
                    ->label('路径标识')
                    ->required(),
                TextInput::make('template')
                    ->label('页面模板')
                    ->required()
                    ->default('standard'),
                TextInput::make('hero_title')
                    ->label('横幅标题'),
                TextInput::make('hero_subtitle')
                    ->label('横幅副标题'),
                FileUpload::make('hero_image')
                    ->label('横幅图片')
                    ->image(),
                TextInput::make('breadcrumb_title')
                    ->label('面包屑标题'),
                Textarea::make('summary')
                    ->label('摘要')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('启用')
                    ->required(),
                TextInput::make('sort_order')
                    ->label('排序')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
