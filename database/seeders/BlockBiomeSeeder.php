<?php

namespace Database\Seeders;

use App\Models\Biome;
use App\Models\Block;
use App\Models\BlockBiome;
use Illuminate\Database\Seeder;

class BlockBiomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BlockBiome::truncate();

        foreach(config('biomeblocks') as $ar) {
            $block = Block::where('slug', $ar['block'])->first();
            $biome = Biome::where('slug', $ar['biome'])->first();

            BlockBiome::create([
                'block_id' => $block->id,
                'biome_id' => $biome->id
            ]);
        }
    }
}
