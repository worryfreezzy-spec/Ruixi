<?php

namespace App\Filament\Admin\Resources\ContactFormFields\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactFormFieldInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('form.name')
                    ->label('Form'),
                TextEntry::make('label'),
                TextEntry::make('name'),
                TextEntry::make('type'),
                TextEntry::make('placeholder')
                    ->placeholder('-'),
                IconEntry::make('is_required')
                    ->boolean(),
                TextEntry::make('sort_order')
                    ->numeric(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
