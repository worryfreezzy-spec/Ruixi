<?php

namespace App\Filament\Admin\Resources\ServiceSections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_id')
                    ->label('所属服务')
                    ->relationship('service', 'title')
                    ->required(),
                TextInput::make('type')
                    ->label('类型')
                    ->required(),
                TextInput::make('title')
                    ->label('标题'),
                TextInput::make('subtitle')
                    ->label('副标题'),
                Textarea::make('description')
                    ->label('说明')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('图片')
                    ->disk('public')
                    ->directory('services')
                    ->image(),
                TextInput::make('sort_order')
                    ->label('排序')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('启用')
                    ->required(),
            ]);
    }
}
