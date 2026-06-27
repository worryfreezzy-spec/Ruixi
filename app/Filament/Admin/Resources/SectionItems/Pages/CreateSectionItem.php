<?php

namespace App\Filament\Admin\Resources\SectionItems\Pages;

use App\Filament\Admin\Resources\SectionItems\SectionItemResource;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionItem;
use Filament\Resources\Pages\CreateRecord;

class CreateSectionItem extends CreateRecord
{
    protected static string $resource = SectionItemResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $home = Page::query()->where('slug', '/')->firstOrFail();

        $section = PageSection::query()->firstOrCreate(
            ['page_id' => $home->id, 'type' => 'feature_grid'],
            [
                'title' => '为什么选择我们',
                'sort_order' => 1,
                'is_active' => true,
            ],
        );

        $data['section_id'] = $section->id;
        $data['sort_order'] = SectionItem::query()->where('section_id', $section->id)->max('sort_order') + 1;
        $data['is_active'] = true;

        return $data;
    }
}
