<?php

namespace App\Filament\Admin\Resources\SiteSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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
                TextColumn::make('logo')
                    ->label('Logo')
                    ->searchable(),
                TextColumn::make('favicon')
                    ->label('网站图标')
                    ->searchable(),
                TextColumn::make('hotline')
                    ->label('热线电话')
                    ->searchable(),
                TextColumn::make('whatsapp_number')
                    ->label('WhatsApp号码')
                    ->searchable(),
                TextColumn::make('whatsapp_url')
                    ->label('WhatsApp链接')
                    ->searchable(),
                TextColumn::make('facebook_url')
                    ->label('Facebook链接')
                    ->searchable(),
                TextColumn::make('instagram_url')
                    ->label('Instagram链接')
                    ->searchable(),
                IconColumn::make('english_button_enabled')
                    ->label('显示英文切换按钮')
                    ->boolean(),
                TextColumn::make('english_button_url')
                    ->label('英文按钮链接')
                    ->searchable(),
                TextColumn::make('terms_page_id')
                    ->label('条款页面')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('privacy_page_id')
                    ->label('隐私政策页面')
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
