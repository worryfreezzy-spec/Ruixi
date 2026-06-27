<?php

namespace App\Filament\Admin\Resources\CeoProfiles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CeoProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('内容位置')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ceo_hero' => '顶部横幅',
                        'ceo_profile' => '履历正文',
                        default => $state,
                    }),
                ImageColumn::make('image_url')
                    ->label('图片')
                    ->square(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
