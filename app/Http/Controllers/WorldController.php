<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;

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
}
