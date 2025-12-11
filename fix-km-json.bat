@echo off
echo Fixing km.json file...
python -c "import json; data = json.load(open('resources/lang/km.json', 'r', encoding='utf-8-sig')); json.dump(data, open('resources/lang/km.json', 'w', encoding='utf-8'), ensure_ascii=False, indent=4)"
echo.
echo ✓ km.json has been fixed!
echo   - BOM removed
echo   - JSON validated
echo.
echo You can now run: php artisan serve
pause
