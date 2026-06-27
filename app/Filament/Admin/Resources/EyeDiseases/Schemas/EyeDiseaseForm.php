<?php

namespace App\Filament\Admin\Resources\EyeDiseases\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Schema;

class EyeDiseaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('category_id'),
                TextInput::make('title')
                    ->label('文章名称')
                    ->required(),
                TextInput::make('slug')
                    ->label('路径标识')
                    ->required(),
                TextInput::make('short_title')
                    ->label('列表显示名称'),
                Textarea::make('summary')
                    ->label('SEO说明/摘要')
                    ->rows(3)
                    ->columnSpanFull(),
                self::imageUpload('hero_image', '详情页横幅图片'),
                self::imagePreview('hero_image_url', '当前横幅图片'),
                self::imageUpload('thumbnail', '列表/详情图片'),
                self::imagePreview('thumbnail_url', '当前缩略图'),
                self::pdfUpload('brochure_pdf', '下载手册 PDF'),
                self::filePreview('brochure_pdf_url', '当前 PDF 文件'),
                TextInput::make('intro_title')
                    ->label('详情页标题'),
                Textarea::make('intro_description')
                    ->label('详情页介绍')
                    ->rows(5)
                    ->columnSpanFull(),
                TextInput::make('benefits_title')
                    ->label('图片说明'),
                Repeater::make('sections')
                    ->label('详情内容区块')
                    ->relationship()
                    ->orderColumn('sort_order')
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? $state['type'] ?? null)
                    ->collapsible()
                    ->cloneable()
                    ->addActionLabel('新增内容区块')
                    ->schema([
                        TextInput::make('type')
                            ->label('类型')
                            ->helperText('青光眼两栏内容使用 two_column。')
                            ->required(),
                        TextInput::make('title')
                            ->label('标题'),
                        Textarea::make('description')
                            ->label('说明')
                            ->rows(8)
                            ->columnSpanFull(),
                        self::imageUpload('image', '图片'),
                        self::imagePreview('image_url', '当前区块图片'),
                        TextInput::make('sort_order')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('启用')
                            ->default(true),
                        Repeater::make('items')
                            ->label('区块项目')
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->collapsible()
                            ->cloneable()
                            ->addActionLabel('新增区块项目')
                            ->schema([
                                TextInput::make('title')
                                    ->label('标题'),
                                Textarea::make('description')
                                    ->label('说明')
                                    ->rows(6)
                                    ->columnSpanFull(),
                                self::imageUpload('image', '图片'),
                                self::imagePreview('image_url', '当前项目图片'),
                                TextInput::make('sort_order')
                                    ->label('排序')
                                    ->numeric()
                                    ->default(0),
                                Toggle::make('is_active')
                                    ->label('启用')
                                    ->default(true),
                            ])
                            ->columnSpanFull(),
                    ])
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
            ->directory('services')
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

    private static function pdfUpload(string $name, string $label): FileUpload
    {
        return FileUpload::make($name)
            ->label($label)
            ->disk('public')
            ->directory('services/pdf')
            ->acceptedFileTypes(['application/pdf'])
            ->fetchFileInformation(false)
            ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
                $clean = ltrim($file, '/');

                if (str_starts_with($clean, 'static/')) {
                    $path = public_path($clean);

                    return [
                        'name' => basename($clean),
                        'size' => is_file($path) ? filesize($path) : 0,
                        'type' => 'application/pdf',
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

            $safeUrl = e($url);
            $safeLabel = e($label);

            return <<<HTML
                <div style="margin-top:-.5rem">
                    <div style="font-size:.875rem;font-weight:500;margin-bottom:.35rem;color:#374151;">{$safeLabel}</div>
                    <img src="{$safeUrl}" alt="{$safeLabel}" style="max-width:260px;max-height:150px;border-radius:6px;border:1px solid #e5e7eb;object-fit:cover;background:#fff;">
                </div>
            HTML;
        });
    }

    private static function filePreview(string $attribute, string $label): Html
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
                    <a href="{$safeUrl}" target="_blank" rel="noopener" style="display:inline-flex;align-items:center;gap:.4rem;border:1px solid #d1d5db;border-radius:6px;padding:.45rem .75rem;font-size:.875rem;color:#1f2937;text-decoration:none;background:#fff;">查看 PDF</a>
                </div>
            HTML;
        });
    }
}
