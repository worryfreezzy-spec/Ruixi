<?php

namespace App\Filament\Admin\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基础信息')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('网站名称')
                            ->required()
                            ->default('RXZX'),
                        TextInput::make('hotline')
                            ->label('热线电话'),
                        TextInput::make('whatsapp_number')
                            ->label('WhatsApp号码'),
                        TextInput::make('whatsapp_url')
                            ->label('WhatsApp链接')
                            ->url()
                            ->maxLength(255),
                        FileUpload::make('favicon')
                            ->label('ICO图标')
                            ->helperText('建议上传 .ico 文件，用于浏览器标签页图标。')
                            ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon', '.ico'])
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public'),
                    ])
                    ->columns(2),

                Section::make('头部内容')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('头部LOGO')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public'),
                        Toggle::make('english_button_enabled')
                            ->label('显示英文网站切换按钮')
                            ->required(),
                        TextInput::make('english_button_url')
                            ->label('英文网站切换链接')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('底部内容')
                    ->schema([
                        FileUpload::make('footer_logo')
                            ->label('底部LOGO')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public'),
                        Textarea::make('footer_license_text')
                            ->label('底部许可文字')
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('copyright_text')
                            ->label('版权文字')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('社交媒体')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->label('Facebook链接')
                            ->maxLength(255),
                        FileUpload::make('facebook_icon')
                            ->label('Facebook图标')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public'),
                        TextInput::make('instagram_url')
                            ->label('Instagram链接')
                            ->maxLength(255),
                        FileUpload::make('instagram_icon')
                            ->label('Instagram图标')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->visibility('public'),
                    ])
                    ->columns(2),
            ]);
    }
}
