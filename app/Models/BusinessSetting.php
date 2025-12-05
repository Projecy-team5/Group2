<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'address',
        'footer_text',
        'logo',
        'favicon',
    ];

    protected $appends = [
        'logo_url',
        'favicon_url',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->resolvePublicAssetUrl($this->logo);
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->resolvePublicAssetUrl($this->favicon);
    }

    /**
     * Build a URL to a file stored on the public disk.
     *
     * When APP_URL points somewhere other than the current host (different dev
     * port, valet domain, etc.) the generated Storage URL won't resolve. Strip
     * the configured base so the browser falls back to the current origin.
     */
    protected function resolvePublicAssetUrl(?string $file): ?string
    {
        if (!$file) {
            return null;
        }

        $url = Storage::disk('public')->url($file);
        $appUrl = rtrim((string) config('app.url'), '/');

        if ($appUrl !== '' && Str::startsWith($url, $appUrl)) {
            return Str::replaceFirst($appUrl, '', $url) ?: '/';
        }

        return $url;
    }
}
