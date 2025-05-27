<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::factory()->create([
            'name_ar' => 'مصر',
            'name_en' => 'Egypt',
            'main' => 1,
            'code' => '+20',
        ]);

        Country::factory()->count(25)->create();
    }
}
