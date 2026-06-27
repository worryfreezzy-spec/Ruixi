<?php

namespace App\Filament\Admin\Resources\SeoMetas\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SeoMetaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('page_path')->label('页面路径'),
                IconEntry::make('is_active')->label('启用')->boolean(),
                TextEntry::make('meta_title')->label('SEO标题')->placeholder('-'),
                TextEntry::make('meta_description')->label('SEO描述')->placeholder('-')->columnSpanFull(),
                TextEntry::make('meta_keywords')->label('SEO关键词')->placeholder('-')->columnSpanFull(),
                TextEntry::make('canonical_url')->label('规范链接')->placeholder('-'),
                TextEntry::make('og_title')->label('分享标题')->placeholder('-'),
                TextEntry::make('og_description')->label('分享描述')->placeholder('-')->columnSpanFull(),
                ImageEntry::make('og_image')->label('分享图片')->disk('public')->placeholder('-'),
            ]);
    }
}
