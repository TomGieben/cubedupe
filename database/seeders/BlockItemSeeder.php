<?php

namespace Database\Seeders;

use App\Models\BlockItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Block;
use App\Models\Item;

class BlockItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockItem::truncate();

        foreach(config('blockitems') as $ar) {
            $block = Block::where('slug', $ar[1])->first();
            $item = Item::where('slug', $ar[0])->first();

            BlockItem::create([
                'item_id' => $item->id,
                'block_id' => $block->id,
                'damage' => $ar[2],
            ]);
        }
    }
}
