<?php

namespace App\Filament\Admin\Resources\Doctors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DoctorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('名称')
                    ->required(),
                TextInput::make('slug')
                    ->label('路径标识')
                    ->required(),
                FileUpload::make('photo')
                    ->label('图片')
                    ->disk('public')
                    ->directory('doctors')
                    ->image(),
                TextInput::make('position')
                    ->label('职位'),
                Textarea::make('qualification')
                    ->label('学历')
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('specialty')
                    ->label('专科领域')
                    ->rows(4)
                    ->columnSpanFull(),
                Textarea::make('languages')
                    ->label('语言')
                    ->rows(2)
                    ->columnSpanFull(),
                Textarea::make('branches')
                    ->label('分行')
                    ->rows(2)
                    ->columnSpanFull(),
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
