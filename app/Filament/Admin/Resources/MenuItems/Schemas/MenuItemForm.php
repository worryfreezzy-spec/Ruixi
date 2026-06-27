<?php

namespace App\Filament\Admin\Resources\MenuItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('menu_id')
                    ->label('所属导航')
                    ->relationship('menu', 'name')
                    ->required(),
                Select::make('parent_id')
                    ->label('上级')
                    ->relationship('parent', 'title'),
                Select::make('page_id')
                    ->label('关联页面')
                    ->relationship('page', 'title'),
                TextInput::make('title')
                    ->label('标题')
                    ->required(),
                TextInput::make('url')
                    ->label('链接')
                    ->url(),
                TextInput::make('target')
                    ->label('打开方式')
                    ->required()
                    ->default('_self'),
                TextInput::make('icon')
                    ->label('图标'),
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
