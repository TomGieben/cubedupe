<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        return view('welcome', [
            'hasworld' => World::where('user_id', auth()->user()->id)->exists()
        ]);
    }
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
