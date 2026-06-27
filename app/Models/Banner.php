<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $guarded = [];

    public function getImageUrlAttribute(): string
    {
        if (str_starts_with($this->image, 'static/')) {
            return asset($this->image);
        }

        return Storage::disk('public')->url($this->image);
    }

    public function getMobileImageUrlAttribute(): ?string
    {
        if (! $this->mobile_image) {
            return null;
        }

        if (str_starts_with($this->mobile_image, 'static/')) {
            return asset($this->mobile_image);
        }

        return Storage::disk('public')->url($this->mobile_image);
    }
}
