<?php

$file = 'resources/lang/km.json';

// Read file
$content = file_get_contents($file);

// Remove BOM if present
$content = str_replace("\xEF\xBB\xBF", '', $content);

// Fix escaped quotes (replace \\' with ')
$content = str_replace("\\'", "'", $content);

// Decode JSON
$json = json_decode($content, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'JSON Error: ' . json_last_error_msg() . PHP_EOL;
    echo 'Content preview: ' . substr($content, 0, 500) . PHP_EOL;
    exit(1);
}

// Write back without BOM, properly formatted
file_put_contents($file, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Fixed successfully - BOM removed, quotes fixed, and JSON validated" . PHP_EOL;
