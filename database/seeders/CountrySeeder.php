<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $egypt = Country::factory()->create([
            'main' => 1,
            'code' => '+20',
        ]);

        foreach (['ar', 'en'] as $lang) {
            DB::table('country_translations')->insert([
                'country_id' => $egypt->id,
                'language' => $lang,
                'name' => $lang === 'ar' ? 'مصر' : 'Egypt',
            ]);
        }
        

        Country::factory()->count(25)->create()->each(function ($country) {
            $countryName = fake()->country();

            foreach (['ar', 'en'] as $lang) {
                DB::table('country_translations')->insert([
                    'country_id' => $country->id,
                    'language' => $lang,
                    'name' => $countryName,
                ]);
            }
        });

    }
}
