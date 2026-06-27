<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'english_button_enabled' => 'boolean',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->assetUrl($this->logo);
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->assetUrl($this->favicon);
    }

    public function getFooterLogoUrlAttribute(): ?string
    {
        return $this->assetUrl($this->footer_logo);
    }

    public function getFacebookIconUrlAttribute(): ?string
    {
        return $this->assetUrl($this->facebook_icon);
    }

    public function getInstagramIconUrlAttribute(): ?string
    {
        return $this->assetUrl($this->instagram_icon);
    }

    private function assetUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        if (str_starts_with($path, 'static/')) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }
}
