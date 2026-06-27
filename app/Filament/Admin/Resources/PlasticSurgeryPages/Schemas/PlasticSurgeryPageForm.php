<?php

namespace App\Filament\Admin\Resources\PlasticSurgeryPages\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlasticSurgeryPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('页面基础信息')
                    ->schema([
                        TextInput::make('title')
                            ->label('页面标题')
                            ->required(),
                        TextInput::make('slug')
                            ->label('路径标识')
                            ->required(),
                        Hidden::make('template')
                            ->default('plastic_surgery'),
                        TextInput::make('breadcrumb_title')
                            ->label('上方小标题'),
                        Textarea::make('summary')
                            ->label('页面说明')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('横幅设置')
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('横幅标题'),
                        self::imageUpload('hero_image', '横幅图片'),
                        self::imagePreview('hero_image_url', '当前横幅图片'),
                    ])
                    ->columns(2),
                Repeater::make('sections')
                    ->label('服务列表标题')
                    ->relationship('sections', fn ($query) => $query->where('type', 'plastic_services'))
                    ->orderColumn('sort_order')
                    ->addable(false)
                    ->deletable(false)
                    ->reorderable(false)
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? '服务清单')
                    ->schema([
                        Hidden::make('type'),
                        TextInput::make('title')
                            ->label('列表标题'),
                        Hidden::make('sort_order'),
                        Hidden::make('is_active')
                            ->default(true),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    private static function imageUpload(string $name, string $label): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('public')
            ->directory('pages')
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

            return '<div style="margin-top:-.5rem"><div style="font-size:.875rem;font-weight:500;margin-bottom:.35rem;color:#374151;">' . e($label) . '</div><img src="' . e($url) . '" alt="' . e($label) . '" style="max-width:360px;max-height:180px;border-radius:6px;border:1px solid #e5e7eb;object-fit:cover;background:#fff;"></div>';
        });
    }
}
