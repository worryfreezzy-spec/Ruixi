<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class ServiceCategory extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id')->orderBy('sort_order');
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        return $this->assetUrl($this->hero_image);
    }

    public function getSymptomImageUrlAttribute(): ?string
    {
        return $this->assetUrl($this->symptom_image);
    }

    private function assetUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $clean = ltrim($path, '/');

        if (str_starts_with($clean, 'static/')) {
            return asset($clean);
        }

        return Storage::disk('public')->url($clean);
    }
}
