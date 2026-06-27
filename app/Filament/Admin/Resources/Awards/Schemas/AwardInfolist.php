<?php

namespace App\Filament\Admin\Resources\Awards\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AwardInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('标题'),
                ImageEntry::make('image_url')
                    ->label('图片'),
                TextEntry::make('link_url')
                    ->label('链接')
                    ->placeholder('-'),
            ]);
    }
}
