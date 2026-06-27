<?php

namespace App\Filament\Admin\Resources\PlasticSurgeryItems\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Schema;

class PlasticSurgeryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('section_id'),
                TextInput::make('title')
                    ->label('标题')
                    ->required(),
                self::imageUpload('image', '图片'),
                self::imagePreview('image_url', '当前图片'),
                Textarea::make('description')
                    ->label('简介')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('排序')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('启用')
                    ->default(true),
            ]);
    }

    private static function imageUpload(string $name, string $label): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('public')
            ->directory('section-items')
            ->image()
            ->fetchFileInformation(false)
            ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
                $clean = ltrim($file, '/');

                if (str_starts_with($clean, 'static/')) {
                    $path = public_path($clean);

                    return [
                        'name' => basename($clean),
                        'size' => is_file($path) ? filesize($path) : 0,
                        'type' => is_file($path) ? mime_content_type($path) : 'image/jpeg',
                        'url' => asset($clean),
                    ];
                }

                return $component->getUploadedFile($file, $storedFileNames);
            });
    }

    private static function imagePreview(string $attribute, string $label): Html
    {
        return Html::make(function ($record = null) use ($attribute, $label): string {
            $url = $record?->{$attribute};

            if (blank($url)) {
                return '';
            }

            return '<div style="margin-top:-.5rem"><div style="font-size:.875rem;font-weight:500;margin-bottom:.35rem;color:#374151;">' . e($label) . '</div><img src="' . e($url) . '" alt="' . e($label) . '" style="max-width:260px;max-height:150px;border-radius:6px;border:1px solid #e5e7eb;object-fit:cover;background:#fff;"></div>';
        });
    }
}
