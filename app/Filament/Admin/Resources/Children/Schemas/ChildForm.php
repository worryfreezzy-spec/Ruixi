<?php

namespace App\Filament\Admin\Resources\Children\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ChildForm
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
                        Textarea::make('summary')
                            ->label('SEO说明 / 摘要')
                            ->rows(3)
                            ->columnSpanFull(),
                        self::imageUpload('hero_image', '详情页横幅图片'),
                        self::imageUpload('thumbnail', '列表缩略图'),
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
                Repeater::make('sections')
                    ->label('详情内容区块')
                    ->relationship()
                    ->orderColumn('sort_order')
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? $state['type'] ?? null)
                    ->collapsible()
                    ->cloneable()
                    ->addActionLabel('新增内容区块')
                    ->schema([
                        Select::make('type')
                            ->label('布局类型')
                            ->options([
                                'image_right' => '文字左侧，图片右侧',
                                'image_left_blue' => '图片左侧，文字右侧蓝底',
                            ])
                            ->default('image_right')
                            ->required(),
                        TextInput::make('title')
                            ->label('标题'),
                        Textarea::make('description')
                            ->label('说明')
                            ->helperText('每行一段；列表项用 - 开头。')
                            ->rows(8)
                            ->columnSpanFull(),
                        self::imageUpload('image', '图片'),
                        TextInput::make('sort_order')
                            ->label('排序')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('启用')
                            ->default(true),
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
}
