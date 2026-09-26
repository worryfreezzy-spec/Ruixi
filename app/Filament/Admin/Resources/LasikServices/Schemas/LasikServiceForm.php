<?php

namespace App\Filament\Admin\Resources\LasikServices\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LasikServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('category_id'),
                Section::make('基础信息')
                    ->schema([
                        TextInput::make('title')
                            ->label('文章名称')
                            ->required(),
                        TextInput::make('slug')
                            ->label('路径标识')
                            ->required(),
                        TextInput::make('short_title')
                            ->label('列表显示名称'),
                        self::fileUpload('hero_image', '详情页横幅图片', ['image/jpeg', 'image/png', 'image/webp']),
                        self::fileUpload('thumbnail', '列表缩略图', ['image/jpeg', 'image/png', 'image/webp']),
                    ])
                    ->columns(2),
            ]);
    }

    private static function fileUpload(string $name, string $label, array $types): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('public')
            ->directory('services')
            ->acceptedFileTypes($types)
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
