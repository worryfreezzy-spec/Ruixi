<?php

namespace App\Filament\Admin\Resources\Banners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('电脑端图片')
                    ->square(),
                ImageColumn::make('mobile_image_url')
                    ->label('手机端图片')
                    ->square(),
                TextColumn::make('link_url')
                    ->label('跳转链接')
                    ->searchable()
                    ->limit(50),
            ])
            ->recordActions([
                EditAction::make()->label('编辑'),
                DeleteAction::make()->label('删除'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
