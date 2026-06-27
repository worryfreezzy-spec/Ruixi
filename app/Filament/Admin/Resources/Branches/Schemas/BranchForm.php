<?php

namespace App\Filament\Admin\Resources\Branches\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('基础信息')
                ->schema([
                    Select::make('city_id')->label('所属城市')->relationship('city', 'name')->required(),
                    TextInput::make('title')->label('分行标题')->required(),
                    TextInput::make('slug')->label('路径标识')->required(),
                    TextInput::make('sort_order')->label('排序')->numeric()->default(0),
                    Toggle::make('is_active')->label('启用')->default(true),
                ])
                ->columns(2),
            Section::make('联系信息')
                ->schema([
                    Textarea::make('address')->label('地址')->rows(4)->columnSpanFull(),
                    TextInput::make('phone')->label('电话'),
                    TextInput::make('whatsapp')->label('WhatsApp'),
                    TextInput::make('email')->label('电子邮件'),
                    Textarea::make('business_hours')->label('营业时间')->rows(4)->columnSpanFull(),
                ])
                ->columns(2),
            Section::make('按钮与地图')
                ->schema([
                    TextInput::make('contact_url')->label('联系我们按钮链接'),
                    TextInput::make('street_view_url')->label('Street View 链接'),
                    TextInput::make('waze_url')->label('Waze 链接'),
                    Textarea::make('map_embed')->label('地图 iframe 代码')->rows(6)->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }
}
