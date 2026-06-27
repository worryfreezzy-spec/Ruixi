<?php

namespace App\Filament\Admin\Resources\LasikCategories\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LasikCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('列表页基础信息')
                    ->schema([
                        TextInput::make('title')
                            ->label('页面名称')
                            ->required(),
                        TextInput::make('slug')
                            ->label('路径标识')
                            ->required(),
                        Hidden::make('type')
                            ->default('lasik'),
                        TextInput::make('sort_order')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('启用')
                            ->default(true),
                    ])
                    ->columns(2),
                Section::make('横幅设置')
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('横幅标题'),
                        self::imageUpload('hero_image', '横幅图片'),
                    ])
                    ->columns(2),
                Section::make('页面介绍')
                    ->schema([
                        TextInput::make('intro_title')
                            ->label('介绍标题'),
                        Textarea::make('intro_description')
                            ->label('介绍副标题')
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('介绍说明 / SEO说明')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    private static function imageUpload(string $name, string $label): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('public')
            ->directory('service-categories')
            ->image()
            ->fetchFileInformation(false)
            ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
                $clean = ltrim($file, '/');

                if (str_starts_with($clean, 'static/')) {
                    $path = public_path($clean);

                    return [
                        'name' => basename($clean),
                        'size' => is_file($path) ? filesize($path) : 0,
                        'type' => is_file($path) ? mime_content_type($path) : null,
                        'url' => asset($clean),
                    ];
                }

                return $component->getUploadedFile($file, $storedFileNames);
            });
    }
}
