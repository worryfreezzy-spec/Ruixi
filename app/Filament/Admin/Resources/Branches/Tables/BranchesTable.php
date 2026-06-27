<?php

namespace App\Filament\Admin\Resources\Branches\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('分行标题')->searchable(),
                TextColumn::make('city.name')->label('城市')->sortable(),
                TextColumn::make('phone')->label('电话'),
                TextColumn::make('sort_order')->label('排序')->sortable(),
                IconColumn::make('is_active')->label('启用')->boolean(),
            ])
            ->recordActions([
                EditAction::make()->label('编辑'),
                DeleteAction::make()->label('删除'),
            ])
            ->toolbarActions([]);
    }
}
