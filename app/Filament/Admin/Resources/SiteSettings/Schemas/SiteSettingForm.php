<?php

namespace App\Filament\Admin\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('网站名称')
                    ->required()
                    ->default('RXZX'),
                TextInput::make('logo')
                    ->label('Logo'),
                TextInput::make('favicon')
                    ->label('网站图标'),
                TextInput::make('hotline')
                    ->label('热线电话'),
                TextInput::make('whatsapp_number')
                    ->label('WhatsApp号码'),
                TextInput::make('whatsapp_url')
                    ->label('WhatsApp链接')
                    ->url(),
                TextInput::make('facebook_url')
                    ->label('Facebook链接')
                    ->url(),
                TextInput::make('instagram_url')
                    ->label('Instagram链接')
                    ->url(),
                Toggle::make('english_button_enabled')
                    ->label('显示英文切换按钮')
                    ->required(),
                TextInput::make('english_button_url')
                    ->label('英文按钮链接')
                    ->url(),
                Textarea::make('footer_license_text')
                    ->label('页脚许可证文字')
                    ->columnSpanFull(),
                Textarea::make('copyright_text')
                    ->label('版权文字')
                    ->columnSpanFull(),
                TextInput::make('terms_page_id')
                    ->label('条款页面')
                    ->numeric(),
                TextInput::make('privacy_page_id')
                    ->label('隐私政策页面')
                    ->numeric(),
            ]);
    }
}
