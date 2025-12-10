
<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicStorageUrl
{
    /**
     * Build a browser-accessible URL for a path stored on the public disk.
     *
     * Returns relative paths when APP_URL points somewhere else (like localhost)
     * so uploaded assets keep working for any origin that serves the app.
     */
    public static function resolve(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $normalized = ltrim($path, '/');

        if (Str::startsWith($normalized, ['http://', 'https://'])) {
            return $normalized;
        }

        if (Str::startsWith($normalized, 'storage/')) {
            $normalized = Str::replaceFirst('storage/', '', $normalized);
        }

        if (Str::startsWith($normalized, 'public/')) {
            $normalized = Str::replaceFirst('public/', '', $normalized);
        }

        $url = Storage::disk('public')->url($normalized);
        $appUrl = rtrim((string) config('app.url'), '/');

        if ($appUrl !== '' && Str::startsWith($url, $appUrl)) {
            $relative = Str::replaceFirst($appUrl, '', $url);

            return $relative === '' ? '/' : $relative;
        }

        return $url;
    }
}
