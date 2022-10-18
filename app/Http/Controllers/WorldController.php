<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlockItem;
use App\Models\World;
use App\Models\Item;
use App\Models\Block;

class WorldController extends Controller
{
    public function index()
    {
        $world = auth()->user()->worlds()->latest()->first();

        return view('game', [
            // 'blocks' => $blocks,
            'world' => $world,
        ]);
    }

    public function update(Request $request) {
        $world = auth()->user()->worlds()->latest()->first();

        $world->update([
            'html' => $request->html,
        ]);

        return true;
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:30',
        ]);

        World::new([
            'name' => $request->name,
        ]);

        return redirect()->route('game');
    }

    public function item(Request $request) {
        $item = Item::select('id')->where('slug', $request->item)->first();
        $block = Block::select('id')->where('slug', $request->block)->first();
        $damage = BlockItem::query()
            ->select('damage')
            ->where('block_id', $block->id)
            ->where('item_id', $item->id)
            ->first()
            ->damage;

        return $damage;
    }
}
