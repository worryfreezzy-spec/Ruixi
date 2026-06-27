<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ContactCta extends Model
{
    protected $guarded = [];

    protected $casts = [
        'show_form' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getBackgroundImageUrlAttribute(): ?string
    {
        if (blank($this->background_image)) {
            return null;
        }

        if (str_starts_with($this->background_image, 'http://') || str_starts_with($this->background_image, 'https://')) {
            return $this->background_image;
        }

        $clean = ltrim($this->background_image, '/');

        if (str_starts_with($clean, 'static/')) {
            return asset($clean);
        }

        return Storage::disk('public')->url($clean);
    }
}
