<?php

namespace App\Filament\Admin\Resources\Pages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parent.title')
                    ->label('上级')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('路径标识')
                    ->searchable(),
                TextColumn::make('template')
                    ->label('页面模板')
                    ->searchable(),
                TextColumn::make('hero_title')
                    ->label('横幅标题')
                    ->searchable(),
                TextColumn::make('hero_subtitle')
                    ->label('横幅副标题')
                    ->searchable(),
                ImageColumn::make('hero_image')
                    ->label('横幅图片'),
                TextColumn::make('breadcrumb_title')
                    ->label('面包屑标题')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('启用')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->sortable(),
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
