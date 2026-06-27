<?php

namespace App\Filament\Admin\Resources\SeoMetas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SeoMetaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('model_type')
                    ->label('模型类型')
                    ->required(),
                TextInput::make('model_id')
                    ->label('模型ID')
                    ->required()
                    ->numeric(),
                TextInput::make('meta_title')
                    ->label('SEO标题'),
                Textarea::make('meta_description')
                    ->label('SEO描述')
                    ->columnSpanFull(),
                Textarea::make('meta_keywords')
                    ->label('SEO关键词')
                    ->columnSpanFull(),
                TextInput::make('og_title')
                    ->label('分享标题'),
                Textarea::make('og_description')
                    ->label('分享描述')
                    ->columnSpanFull(),
                FileUpload::make('og_image')
                    ->label('分享图片')
                    ->image(),
                TextInput::make('canonical_url')
                    ->label('规范链接')
                    ->url(),
            ]);
    }
}
