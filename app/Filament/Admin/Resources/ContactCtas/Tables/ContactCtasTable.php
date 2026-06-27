<?php

namespace App\Filament\Admin\Resources\ContactCtas\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactCtasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')->label('标识')->searchable(),
                TextColumn::make('title')->label('标题')->searchable(),
                ImageColumn::make('background_image_url')->label('背景图片')->square(),
                IconColumn::make('show_form')->label('显示表单')->boolean(),
                IconColumn::make('is_active')->label('启用')->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
