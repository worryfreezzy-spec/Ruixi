<?php

namespace App\Filament\Admin\Resources\ContactSubmissions\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ContactSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('姓名')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('电话')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('电邮')
                    ->searchable(),
                TextColumn::make('treatment')
                    ->label('咨询项目')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('page')
                    ->label('来源页面')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('状态')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => [
                        'new' => '新提交',
                        'contacted' => '已联系',
                        'completed' => '已完成',
                        'invalid' => '无效信息',
                    ][$state] ?? $state),
                TextColumn::make('created_at')
                    ->label('提交时间')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('状态')
                    ->options([
                        'new' => '新提交',
                        'contacted' => '已联系',
                        'completed' => '已完成',
                        'invalid' => '无效信息',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()->label('查看'),
            ])
            ->toolbarActions([]);
    }
}
