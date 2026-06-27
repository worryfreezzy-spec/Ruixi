<?php

namespace App\Filament\Admin\Resources\EyeDiseases\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EyeDiseasesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->selectable(false)
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                ImageColumn::make('thumbnail_url')
                    ->label('缩略图'),
                TextColumn::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('启用')
                    ->boolean(),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make()
                    ->label('查看'),
                EditAction::make()
                    ->label('编辑'),
            ])
            ->toolbarActions([]);
    }
}
