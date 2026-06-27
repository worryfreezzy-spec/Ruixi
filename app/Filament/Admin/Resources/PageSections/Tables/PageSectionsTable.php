<?php

namespace App\Filament\Admin\Resources\PageSections\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('图片')
                    ->square(),
                ImageColumn::make('background_image_url')
                    ->label('背景图片')
                    ->square(),
                TextColumn::make('button_text')
                    ->label('按钮文字')
                    ->searchable(),
                TextColumn::make('button_url')
                    ->label('按钮链接')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
