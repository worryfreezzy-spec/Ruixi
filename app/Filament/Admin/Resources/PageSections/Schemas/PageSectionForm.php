<?php

namespace App\Filament\Admin\Resources\PageSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('我们的专科医生')
                    ->schema([
                        TextInput::make('title')
                            ->label('标题'),
                        TextInput::make('doctors_content_one')
                            ->label('内容一'),
                        Textarea::make('doctors_content_two')
                            ->label('内容二')
                            ->rows(4)
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->label('图片')
                            ->disk('public')
                            ->directory('page-sections')
                            ->image(),
                    ])
                    ->columns(2)
                    ->visible(fn ($record): bool => $record?->type === 'doctors_hero'),
                Section::make('最新来自 RXZX')
                    ->schema([
                        TextInput::make('title')
                            ->label('标题'),
                        TextInput::make('subtitle')
                            ->label('内容标题'),
                        Textarea::make('description')
                            ->label('简介')
                            ->rows(4)
                            ->columnSpanFull(),
                        FileUpload::make('background_image')
                            ->label('图片')
                            ->disk('public')
                            ->directory('page-section-backgrounds')
                            ->image(),
                        TextInput::make('button_text')
                            ->label('按钮文字'),
                        TextInput::make('button_url')
                            ->label('按钮链接'),
                    ])
                    ->columns(2)
                    ->visible(fn ($record): bool => $record?->type === 'treatment_highlight'),
                Section::make('区块内容')
                    ->schema([
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
                    ])
                    ->columns(2)
                    ->visible(fn ($record): bool => ! in_array($record?->type, ['doctors_hero', 'treatment_highlight'], true)),
            ]);
    }
}
