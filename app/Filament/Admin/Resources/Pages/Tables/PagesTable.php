<?php

namespace App\Filament\Admin\Resources\Pages\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
            ])
            ->recordActions([
                ViewAction::make()->label('查看'),
                EditAction::make()->label('编辑'),
            ])
            ->toolbarActions([]);
    }
}
