<?php

namespace App\Filament\Admin\Resources\ContactCtas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactCtaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextInput::make('key')
                            ->label('标识')
                            ->helperText('用于页面调用，例如 treatment_registration。')
                            ->required(),
                        Toggle::make('show_form')
                            ->label('显示表单')
                            ->default(false),
                        Toggle::make('is_active')
                            ->label('启用')
                            ->default(true),
                    ])
                    ->columns(3),
                Section::make('文字内容')
                    ->schema([
                        TextInput::make('subtitle')
                            ->label('小标题'),
                        TextInput::make('title')
                            ->label('标题'),
                        Textarea::make('description')
                            ->label('说明')
                            ->rows(5)
                            ->columnSpanFull(),
                        Textarea::make('extra_text')
                            ->label('补充说明')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('note')
                            ->label('备注'),
                    ])
                    ->columns(2),
                Section::make('按钮与图片')
                    ->schema([
                        TextInput::make('button_text')
                            ->label('按钮文字'),
                        TextInput::make('button_url')
                            ->label('按钮链接'),
                        FileUpload::make('background_image')
                            ->label('背景图片')
                            ->disk('public')
                            ->directory('contact')
                            ->image()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
