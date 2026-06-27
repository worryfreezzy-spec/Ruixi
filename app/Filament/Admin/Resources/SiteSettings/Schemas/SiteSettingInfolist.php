<?php

namespace App\Filament\Admin\Resources\SiteSettings\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteSettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('site_name'),
                TextEntry::make('logo')
                    ->placeholder('-'),
                TextEntry::make('favicon')
                    ->placeholder('-'),
                TextEntry::make('hotline')
                    ->placeholder('-'),
                TextEntry::make('whatsapp_number')
                    ->placeholder('-'),
                TextEntry::make('whatsapp_url')
                    ->placeholder('-'),
                TextEntry::make('facebook_url')
                    ->placeholder('-'),
                TextEntry::make('instagram_url')
                    ->placeholder('-'),
                IconEntry::make('english_button_enabled')
                    ->boolean(),
                TextEntry::make('english_button_url')
                    ->placeholder('-'),
                TextEntry::make('footer_license_text')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('copyright_text')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('terms_page_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('privacy_page_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
