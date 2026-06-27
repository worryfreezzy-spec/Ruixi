<?php

namespace App\Filament\Admin\Resources\PageSections\Pages;

use App\Filament\Admin\Resources\PageSections\PageSectionResource;
use App\Models\PageSection;
use Filament\Resources\Pages\EditRecord;

class EditPageSection extends EditRecord
{
    protected static string $resource = PageSectionResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->type === 'doctors_hero') {
            $intro = $this->relatedSection('doctors_intro');

            $data['doctors_content_one'] = $intro?->title;
            $data['doctors_content_two'] = $intro?->description;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($this->record->type === 'doctors_hero') {
            $this->relatedSection('doctors_intro')?->update([
                'title' => $data['doctors_content_one'] ?? null,
                'description' => $data['doctors_content_two'] ?? null,
            ]);

            unset($data['doctors_content_one'], $data['doctors_content_two']);
        }

        return $data;
    }

    private function relatedSection(string $type): ?PageSection
    {
        return PageSection::query()
            ->where('page_id', $this->record->page_id)
            ->where('type', $type)
            ->first();
    }
}
