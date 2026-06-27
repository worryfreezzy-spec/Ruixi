<?php

namespace App\Filament\Admin\Resources\CataractServices\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CataractServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                ImageColumn::make('hero_image_url')
                    ->label('横幅图片'),
            ])
            ->recordActions([
                ViewAction::make()->label('查看'),
                EditAction::make()->label('编辑'),
                DeleteAction::make()->label('删除'),
            ])
            ->toolbarActions([]);
    }
}
