<?php

namespace App\Filament\Admin\Resources\LasikServices\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LasikServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')->label('标题'),
                ImageEntry::make('thumbnail_url')->label('缩略图'),
                TextEntry::make('sort_order')->label('排序'),
                IconEntry::make('is_active')->label('启用')->boolean(),
            ]);
    }
}
