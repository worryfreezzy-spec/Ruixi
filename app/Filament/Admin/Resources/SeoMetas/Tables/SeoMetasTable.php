<?php

namespace App\Filament\Admin\Resources\SeoMetas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeoMetasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model_type')
                    ->label('模型类型')
                    ->searchable(),
                TextColumn::make('model_id')
                    ->label('模型ID')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('meta_title')
                    ->label('SEO标题')
                    ->searchable(),
                TextColumn::make('og_title')
                    ->label('分享标题')
                    ->searchable(),
                ImageColumn::make('og_image')
                    ->label('分享图片'),
                TextColumn::make('canonical_url')
                    ->label('规范链接')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('创建时间')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('更新时间')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
