<?php

namespace App\Filament\Admin\Resources\SeoMetas\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeoMetasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_path')
                    ->label('页面路径')
                    ->searchable(),
                TextColumn::make('meta_title')
                    ->label('SEO标题')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('meta_description')
                    ->label('SEO描述')
                    ->limit(50),
                ImageColumn::make('og_image')
                    ->label('分享图片')
                    ->disk('public'),
                IconColumn::make('is_active')
                    ->label('启用')
                    ->boolean(),
            ])
            ->recordActions([
                ViewAction::make()->label('查看'),
                EditAction::make()->label('编辑'),
                DeleteAction::make()->label('删除'),
            ])
            ->toolbarActions([]);
    }
}
