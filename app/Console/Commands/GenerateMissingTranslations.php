<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateMissingTranslations extends Command
{
    protected $signature = 'translations:generate';
    protected $description = 'Generate missing translation keys from Blade files';

    protected $languages = ['en', 'km', 'zh'];

    public function handle()
    {
        $translationKeys = $this->collectTranslationKeys();

        foreach ($this->languages as $language) {
            $this->updateLangFile($language, $translationKeys);
        }

        $this->info('Missing translations have been added to the language files.');
    }

    protected function collectTranslationKeys(): array
    {
        $bladeFiles = File::allFiles(resource_path('views'));
        $translationKeys = [];

        foreach ($bladeFiles as $file) {
            preg_match_all('/__\(([\'"])(.*?)\1\)/', File::get($file), $matches);
            $translationKeys = array_merge($translationKeys, $matches[2]);
        }

        return array_unique($translationKeys);
    }

    protected function updateLangFile(string $language, array $keys)
    {
        $langPath = resource_path("lang/{$language}.json");
        $translations = File::exists($langPath) ? json_decode(File::get($langPath), true) : [];

        $newKeys = array_filter($keys, function ($key) use ($translations) {
            return !array_key_exists($key, $translations);
        });

        foreach ($newKeys as $key) {
            if ($language === 'km') {
                $translations[$key] = 'សូមបញ្ចូលការបកប្រែ'; // Khmer: "Please add translation"
            } elseif ($language === 'zh') {
                $translations[$key] = '请添加翻译'; // Chinese: "Please add translation"
            } else {
                $translations[$key] = $key; // English: keep the original key
            }
        }

        if (!empty($newKeys)) {
            File::put($langPath, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }
}
