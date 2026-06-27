<?php

namespace App\Filament\Admin\Resources\MenuItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('menu.name')
                    ->label('所属导航')
                    ->searchable(),
                TextColumn::make('parent.title')
                    ->label('上级')
                    ->searchable(),
                TextColumn::make('page.title')
                    ->label('关联页面')
                    ->searchable(),
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                TextColumn::make('url')
                    ->label('链接')
                    ->searchable(),
                TextColumn::make('target')
                    ->label('打开方式')
                    ->searchable(),
                TextColumn::make('icon')
                    ->label('图标')
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('启用')
                    ->boolean(),
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
