<?php

namespace App\Filament\Admin\Resources\LasikServices\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                Section::make('详情顶部内容')
                    ->schema([
                        TextInput::make('intro_title')
                            ->label('详情标题'),
                        Textarea::make('intro_description')
                            ->label('详情说明')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('左侧说明')
                    ->schema([
                        TextInput::make('left_title')
                            ->label('左侧说明标题'),
                        Textarea::make('left_description')
                            ->label('左侧说明 内容')
                            ->rows(6)
                            ->columnSpanFull(),
                        self::fileUpload('left_image', '左侧说明 图片', ['image/jpeg', 'image/png', 'image/webp']),
                        self::fileUpload('detail_media', '程序上方媒体', ['image/jpeg', 'image/png', 'image/webp', 'video/mp4']),
                    ])
                    ->columns(2),
                Section::make('右侧说明')
                    ->schema([
                        TextInput::make('right_title')
                            ->label('右侧标题'),
                        Textarea::make('benefits_title')
                            ->label('详情右侧说明')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Repeater::make('sections')
                    ->label('步骤')
                    ->relationship('sections', fn ($query) => $query->where('type', 'feature_split'))
                    ->orderColumn('sort_order')
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? '步骤')
                    ->addable(false)
                    ->deletable(false)
                    ->reorderable(false)
                    ->collapsible()
                    ->schema([
                        Hidden::make('type'),
                        Hidden::make('title'),
                        Hidden::make('subtitle'),
                        Hidden::make('description'),
                        Hidden::make('image'),
                        Hidden::make('sort_order'),
                        Hidden::make('is_active'),
                        Repeater::make('items')
                            ->label('步骤列表')
                            ->relationship()
                            ->orderColumn('sort_order')
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->collapsible()
                            ->cloneable()
                            ->addActionLabel('新增步骤')
                            ->schema([
                                TextInput::make('title')
                                    ->label('标题'),
                                self::fileUpload('image', '图片', ['image/jpeg', 'image/png', 'image/webp']),
                                Hidden::make('description'),
                                Hidden::make('sort_order'),
                                Hidden::make('is_active')
                                    ->default(true),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('优势')
                    ->schema([
                        TextInput::make('advantages_title')
                            ->label('标题'),
                        Textarea::make('advantages_content')
                            ->label('内容')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),
                Section::make('适合人群')
                    ->schema([
                        TextInput::make('audience_title')
                            ->label('标题'),
                        Textarea::make('audience_content')
                            ->label('内容')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),
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
