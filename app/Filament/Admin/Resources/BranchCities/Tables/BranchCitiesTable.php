<?php

namespace App\Filament\Admin\Resources\BranchCities\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchCitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('城市名称')->searchable(),
                TextColumn::make('slug')->label('路径标识'),
                TextColumn::make('sort_order')->label('排序')->sortable(),
                IconColumn::make('is_active')->label('启用')->boolean(),
            ])
            ->recordActions([EditAction::make()->label('编辑')])
            ->toolbarActions([]);
    }
}
