<?php

namespace App\Filament\Admin\Resources\AboutStories\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AboutStoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                TextColumn::make('subtitle')
                    ->label('副标题')
                    ->limit(60),
                ImageColumn::make('image_url')
                    ->label('图片')
                    ->square(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
