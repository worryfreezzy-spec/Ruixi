<?php

namespace App\Filament\Admin\Resources\MenuItems\Schemas;

use App\Models\Menu;
use App\Models\MenuItem;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema, string $location = 'header'): Schema
    {
        return $schema
            ->components([
                Hidden::make('menu_id')
                    ->default(fn (): ?int => Menu::query()->where('location', $location)->value('id'))
                    ->required(),
                Select::make('parent_id')
                    ->label('上级')
                    ->options(fn (?MenuItem $record): array => MenuItem::query()
                        ->whereHas('menu', fn ($query) => $query->where('location', $location))
                        ->when($record, fn ($query) => $query->whereKeyNot($record->getKey()))
                        ->orderBy('sort_order')
                        ->pluck('title', 'id')
                        ->all())
                    ->searchable()
                    ->preload(),
                TextInput::make('title')
                    ->label('标题')
                    ->required(),
                TextInput::make('url')
                    ->label('链接')
                    ->url(),
                Select::make('target')
                    ->label('打开方式')
                    ->options([
                        '_self' => '当前窗口',
                        '_blank' => '新窗口',
                    ])
                    ->required()
                    ->default('_self'),
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
