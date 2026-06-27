<?php

namespace App\Filament\Admin\Resources\ContactFormFields\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactFormFieldForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('form_id')
                    ->label('所属表单')
                    ->relationship('form', 'name')
                    ->required(),
                TextInput::make('label')
                    ->label('标签')
                    ->required(),
                TextInput::make('name')
                    ->label('名称')
                    ->required(),
                TextInput::make('type')
                    ->label('类型')
                    ->required()
                    ->default('text'),
                TextInput::make('placeholder')
                    ->label('占位文字'),
                TextInput::make('options')
                    ->label('选项'),
                Toggle::make('is_required')
                    ->label('必填')
                    ->required(),
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
