<?php

namespace App\Filament\Admin\Resources\SectionItems\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SectionItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('标题'),
                ImageEntry::make('icon_url')
                    ->label('图标'),
            ]);
    }
}
