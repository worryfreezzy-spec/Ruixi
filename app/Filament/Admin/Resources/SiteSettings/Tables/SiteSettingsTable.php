<?php

namespace App\Filament\Admin\Resources\SiteSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')
                    ->label('网站名称')
                    ->searchable(),
                IconColumn::make('english_button_enabled')
                    ->label('英文切换')
                    ->boolean(),
                TextColumn::make('hotline')
                    ->label('热线电话'),
                TextColumn::make('updated_at')
                    ->label('更新时间')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->label('编辑'),
            ])
            ->toolbarActions([]);
    }
}
