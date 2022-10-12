<?php

namespace Database\Seeders;

use App\Models\Biome;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BiomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Biome::truncate();

        foreach(config('biomes') as $biome){

            Biome::create([
                'name' => $biome['name'],
                'slug' => Str::slug($biome['name']),
            ]);
        }
    }
}
