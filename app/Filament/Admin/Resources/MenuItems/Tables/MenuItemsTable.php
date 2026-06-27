<?php

namespace App\Filament\Admin\Resources\MenuItems\Tables;

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
                TextColumn::make('title')
                    ->label('导航层级')
                    ->formatStateUsing(fn (string $state, $record): string => $record->parent_id ? '──── '.$state : $state)
                    ->description(fn ($record): ?string => $record->parent?->title ? '上级：'.$record->parent->title : '顶级导航')
                    ->searchable()
                    ->weight(fn ($record): string => $record->parent_id ? 'normal' : 'bold'),
                TextColumn::make('url')
                    ->label('链接')
                    ->searchable(),
                TextColumn::make('target')
                    ->label('打开方式')
                    ->formatStateUsing(fn (?string $state): string => $state === '_blank' ? '新窗口' : '当前窗口'),
                TextColumn::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('启用')
                    ->boolean(),
            ])
            ->recordActions([
                ViewAction::make()->label('查看'),
                EditAction::make()->label('编辑'),
            ])
            ->toolbarActions([]);
    }
}
