<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;

class WorldController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:30',
        ]);

        World::new([
            'name' => $request->name,
        ]);

        return redirect()->route('home');
    }
}
