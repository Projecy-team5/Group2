<?php

namespace Database\Seeders;

use App\Models\BusinessSetting;
use Illuminate\Database\Seeder;

class BusinessSettingSeeder extends Seeder
{
    public function run(): void
    {
        BusinessSetting::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Scholarship-Hub',
                'email' => 'scholarshiphub@gmail.com',
                'phone' => '+(855)96-390-390 ',
                'website' => 'https://www.youtube.com/',
                'address' => 'Siem Reap, Cambodia',
                'footer_text' => 'Building pathways to education for every student.',
            ]
        );
    }
}
