<?php

namespace App\Filament\Admin\Resources\ChildrenCategories\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ChildrenCategoryForm
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
                            ->default('children'),
                    ])
                    ->columns(2),
                Section::make('横幅设置')
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('横幅标题'),
                        FileUpload::make('hero_image')
                            ->label('横幅图片')
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
                                        'type' => is_file($path) ? mime_content_type($path) : 'image/jpeg',
                                        'url' => asset($clean),
                                    ];
                                }

                                return $component->getUploadedFile($file, $storedFileNames);
                            }),
                        self::imagePreview('hero_image_url', '当前横幅图片'),
                    ])
                    ->columns(2),
                Section::make('页面介绍')
                    ->schema([
                        TextInput::make('intro_title')
                            ->label('介绍标题'),
                        Textarea::make('intro_description')
                            ->label('介绍说明')
                            ->rows(5)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('SEO说明')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    private static function imagePreview(string $attribute, string $label): Html
    {
        return Html::make(function ($record = null) use ($attribute, $label): string {
            $url = $record?->{$attribute};

            if (blank($url)) {
                return '';
            }

            $safeUrl = e($url);
            $safeLabel = e($label);

            return <<<HTML
                <div style="margin-top:-.5rem">
                    <div style="font-size:.875rem;font-weight:500;margin-bottom:.35rem;color:#374151;">{$safeLabel}</div>
                    <img src="{$safeUrl}" alt="{$safeLabel}" style="max-width:360px;max-height:180px;border-radius:6px;border:1px solid #e5e7eb;object-fit:cover;background:#fff;">
                </div>
            HTML;
        });
    }
}
