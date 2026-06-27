<?php

namespace App\Filament\Admin\Resources\CeoProfiles\Schemas;

use App\Models\PageSection;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CeoProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('标题'),
                TextInput::make('subtitle')
                    ->label('副标题')
                    ->visible(fn (?PageSection $record): bool => $record?->type === 'ceo_profile'),
                Textarea::make('description')
                    ->label('正文')
                    ->rows(12)
                    ->columnSpanFull()
                    ->visible(fn (?PageSection $record): bool => $record?->type === 'ceo_profile'),
                FileUpload::make('image')
                    ->label('图片')
                    ->disk('public')
                    ->directory('about')
                    ->image()
                    ->visible(fn (?PageSection $record): bool => $record?->type === 'ceo_hero'),
            ]);
    }
}
