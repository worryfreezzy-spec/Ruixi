<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(ServiceSection::class)->orderBy('sort_order');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'model');
    }

    public function getHeroImageUrlAttribute(): ?string
    {
        return $this->assetUrl($this->hero_image);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->assetUrl($this->thumbnail);
    }

    public function getBrochurePdfUrlAttribute(): ?string
    {
        return $this->assetUrl($this->brochure_pdf);
    }

    public function getLeftImageUrlAttribute(): ?string
    {
        return $this->assetUrl($this->left_image);
    }

    public function getDetailMediaUrlAttribute(): ?string
    {
        return $this->assetUrl($this->detail_media);
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
