<?php

namespace App\Filament\Admin\Resources\OptimaxAdvantages\Pages;

use App\Filament\Admin\Resources\OptimaxAdvantages\OptimaxAdvantageResource;
use App\Models\PageSection;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Builder;

class CreateOptimaxAdvantage extends CreateRecord
{
    protected static string $resource = OptimaxAdvantageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['section_id'] = PageSection::query()
            ->where('type', 'optimax_advantages')
            ->whereHas('page', fn (Builder $query) => $query->where('slug', 'why-choose-us'))
            ->value('id');

        return $data;
    }
}
