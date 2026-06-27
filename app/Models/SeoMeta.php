<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getOgImageUrlAttribute(): ?string
    {
        if (! $this->og_image) {
            return null;
        }

        if (str_starts_with($this->og_image, 'http://') || str_starts_with($this->og_image, 'https://') || str_starts_with($this->og_image, '/')) {
            return $this->og_image;
        }

        if (str_starts_with($this->og_image, 'static/')) {
            return asset($this->og_image);
        }

        return Storage::disk('public')->url($this->og_image);
    }
}
