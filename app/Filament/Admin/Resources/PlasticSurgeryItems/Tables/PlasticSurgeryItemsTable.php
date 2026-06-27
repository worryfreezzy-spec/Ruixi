<?php

namespace App\Filament\Admin\Resources\PlasticSurgeryItems\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlasticSurgeryItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->selectable(false)
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('图片'),
                TextColumn::make('description')
                    ->label('简介')
                    ->limit(40),
                TextColumn::make('sort_order')
                    ->label('排序')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('启用')
                    ->boolean(),
            ])
            ->recordActions([
                EditAction::make()->label('编辑'),
            ])
            ->toolbarActions([]);
    }
}
