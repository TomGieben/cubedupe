<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Block::truncate();

        foreach(config('blocks') as $block){
            Block::create([
                'name' => $block['name'],
                'slug' => Str::slug($block['name']),
                'color' => $block['color'],
                'texture' => $block['texture'],
                'damage' => $block['damage'],
                'hp' => $block['hp'],
            ]);
        }
    }
}
