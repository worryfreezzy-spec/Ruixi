<?php

namespace App\Filament\Admin\Resources\CataractServices\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CataractServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('category_id'),
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
                    ->rows(3)
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
                    ->rows(5)
                    ->columnSpanFull(),
                Repeater::make('sections')
                    ->label('文章内容区块')
                    ->relationship()
                    ->orderColumn('sort_order')
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? $state['type'] ?? null)
                    ->collapsible()
                    ->cloneable()
                    ->addActionLabel('新增内容区块')
                    ->schema([
                        TextInput::make('type')
                            ->label('类型')
                            ->required(),
                        TextInput::make('title')
                            ->label('标题'),
                        TextInput::make('subtitle')
                            ->label('副标题'),
                        Textarea::make('description')
                            ->label('说明')
                            ->rows(5)
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->label('图片')
                            ->disk('public')
                            ->directory('services')
                            ->image(),
                        TextInput::make('sort_order')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('启用')
                            ->default(true),
                        Repeater::make('items')
                            ->label('文章区块项目')
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->collapsible()
                            ->cloneable()
                            ->addActionLabel('新增区块项目')
                            ->schema([
                                TextInput::make('title')
                                    ->label('标题'),
                                Textarea::make('description')
                                    ->label('说明')
                                    ->rows(4)
                                    ->columnSpanFull(),
                                FileUpload::make('image')
                                    ->label('图片')
                                    ->disk('public')
                                    ->directory('services')
                                    ->image(),
                                TextInput::make('icon')
                                    ->label('图标/文件链接'),
                                TextInput::make('sort_order')
                                    ->label('排序')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('启用')
                                    ->default(true),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('排序')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('启用')
                    ->default(true)
                    ->required(),
            ]);
    }
}
