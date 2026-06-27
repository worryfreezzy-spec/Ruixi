<?php

namespace App\Filament\Admin\Resources\ContactPages\Schemas;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContactPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->label('页面标题')->required(),
            TextInput::make('slug')->label('路径标识')->required(),
            Hidden::make('template')->default('contact'),
            TextInput::make('hero_title')->label('横幅标题'),
            self::imageUpload('hero_image', '横幅图片'),
            Textarea::make('summary')->label('页面说明')->rows(5)->columnSpanFull(),
            Repeater::make('sections')
                ->label('页面文字区块')
                ->relationship('sections', fn ($query) => $query->whereIn('type', ['contact_branches', 'contact_form']))
                ->orderColumn('sort_order')
                ->addable(false)
                ->deletable(false)
                ->reorderable(false)
                ->itemLabel(fn (array $state): ?string => $state['title'] ?? $state['type'] ?? null)
                ->schema([
                    Hidden::make('type'),
                    TextInput::make('title')->label('标题'),
                    TextInput::make('subtitle')->label('提示文字'),
                    Textarea::make('description')->label('说明')->rows(5)->columnSpanFull(),
                    Hidden::make('sort_order'),
                    Hidden::make('is_active')->default(true),
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
}
