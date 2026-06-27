<?php

namespace App\Filament\Admin\Resources\ContactSubmissions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('用户提交信息')
                    ->schema([
                        TextEntry::make('name')->label('姓名')->placeholder('-'),
                        TextEntry::make('phone')->label('电话')->placeholder('-'),
                        TextEntry::make('email')->label('电邮')->placeholder('-'),
                        TextEntry::make('page')->label('来源页面')->placeholder('-'),
                        TextEntry::make('treatment')->label('咨询项目')->placeholder('-'),
                        TextEntry::make('referral')->label('来源标识')->placeholder('-'),
                        TextEntry::make('comments')->label('留言')->placeholder('-')->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('处理信息')
                    ->schema([
                        TextEntry::make('status')
                            ->label('状态')
                            ->formatStateUsing(fn (string $state): string => [
                                'new' => '新提交',
                                'contacted' => '已联系',
                                'completed' => '已完成',
                                'invalid' => '无效信息',
                            ][$state] ?? $state),
                        TextEntry::make('remark')->label('后台备注')->placeholder('-')->columnSpanFull(),
                        TextEntry::make('ip_address')->label('IP')->placeholder('-'),
                        TextEntry::make('created_at')->label('提交时间')->dateTime()->placeholder('-'),
                    ])
                    ->columns(2),
            ]);
    }
}
