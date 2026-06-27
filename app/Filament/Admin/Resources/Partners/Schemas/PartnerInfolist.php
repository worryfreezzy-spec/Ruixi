<?php

namespace App\Filament\Admin\Resources\Partners\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PartnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('标题'),
                ImageEntry::make('logo_url')
                    ->label('图片'),
                TextEntry::make('url')
                    ->label('链接')
                    ->placeholder('-'),
            ]);
    }
}
