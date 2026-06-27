<?php

namespace App\Filament\Admin\Resources\DoctorSections\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DoctorSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('doctor_id')
                    ->label('所属医生')
                    ->relationship('doctor', 'name')
                    ->required(),
                TextInput::make('type')
                    ->label('类型')
                    ->required(),
                TextInput::make('title')
                    ->label('标题'),
                Textarea::make('content')
                    ->label('内容')
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('排序')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
