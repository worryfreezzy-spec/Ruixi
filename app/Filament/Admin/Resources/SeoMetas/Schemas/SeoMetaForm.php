<?php

namespace App\Filament\Admin\Resources\SeoMetas\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SeoMetaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('model_type')
                    ->default('page_path')
                    ->required(),
                Hidden::make('model_id')
                    ->default(0)
                    ->required(),
                Hidden::make('page_path')
                    ->required(),
                Hidden::make('is_active')
                    ->default(true),

                Section::make('基础 SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('SEO标题')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('meta_description')
                            ->label('SEO描述')
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('meta_keywords')
                            ->label('SEO关键词')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('canonical_url')
                            ->label('规范链接')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }
}
