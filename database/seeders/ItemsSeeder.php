<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::truncate();

        foreach(config('items') as $item) {
            Item::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'texture' => $item['texture'],
                'hp' => $item['hp'],
            ]);
        }
    }
}
