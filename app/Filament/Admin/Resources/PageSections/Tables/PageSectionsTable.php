<?php

namespace App\Filament\Admin\Resources\PageSections\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.title')
                    ->label('所属页面')
                    ->formatStateUsing(fn (?string $state, $record): string => match ($record->page?->slug) {
                        '/' => '首页',
                        'doctors' => '我们的专科医生',
                        'plastic-surgery' => '整形外科',
                        'contact' => '联系我们',
                        default => $state ?: '-',
                    })
                    ->searchable(),
                TextColumn::make('type')
                    ->label('区块位置')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'intro_text_image' => '首页简介',
                        'treatment_highlight' => '首页治疗亮点',
                        'payment_plan' => '首页付款方式',
                        'doctors_hero' => '我们的专科医生',
                        'optimax_advantages' => 'OPTIMAX的强大优势',
                        'plastic_services' => '整形外科服务清单',
                        'contact_branches' => '联系我们-分行说明',
                        'contact_form' => '联系我们-预约表单说明',
                        default => $state,
                    })
                    ->searchable(),
                TextColumn::make('title')
                    ->label('标题')
                    ->searchable(),
                ImageColumn::make('image_url')
                    ->label('图片')
                    ->square(),
                ImageColumn::make('background_image_url')
                    ->label('背景图片')
                    ->square(),
                TextColumn::make('button_text')
                    ->label('按钮文字')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('button_url')
                    ->label('按钮链接')
                    ->searchable()
                    ->toggleable(),
            ])
            ->recordActions([
                EditAction::make()->label('编辑'),
            ]);
    }
}
