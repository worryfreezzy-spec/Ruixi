<?php

namespace App\Filament\Admin\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('用户提交信息')
                    ->schema([
                        TextInput::make('name')
                            ->label('姓名')
                            ->required(),
                        TextInput::make('phone')
                            ->label('电话')
                            ->tel()
                            ->required(),
                        TextInput::make('email')
                            ->label('电邮')
                            ->email()
                            ->required(),
                        TextInput::make('page')
                            ->label('来源页面'),
                        TextInput::make('treatment')
                            ->label('咨询项目'),
                        TextInput::make('referral')
                            ->label('来源标识'),
                        Textarea::make('comments')
                            ->label('留言')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('处理状态')
                    ->schema([
                        Select::make('status')
                            ->label('状态')
                            ->options([
                                'new' => '新提交',
                                'contacted' => '已联系',
                                'completed' => '已完成',
                                'invalid' => '无效信息',
                            ])
                            ->required()
                            ->default('new'),
                        Textarea::make('remark')
                            ->label('后台备注')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
