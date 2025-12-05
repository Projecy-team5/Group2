<?php

namespace App\Providers;

use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\support\Str;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('readingTime', function ($content) {
            $wordCount = str_word_count(strip_tags($content));
            $minutes = ceil($wordCount / 200); // 200 words per minute
            return $minutes == 1 ? '1 minute' : "$minutes minutes";
        });

        $businessSettings = null;

        try {
            if (Schema::hasTable('business_settings')) {
                $businessSettings = BusinessSetting::first();
            }
        } catch (Throwable $e) {
            $businessSettings = null;
        }

        View::share('businessSettings', $businessSettings);
    }
}
