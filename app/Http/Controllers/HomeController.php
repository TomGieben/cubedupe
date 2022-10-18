<?php

namespace App\Http\Controllers;

use App\Models\World;
class HomeController extends Controller
{
    public function index(){
        $world = World::where('user_id', auth()->user()->id)->first();
        return view('home', [
            'world' => $world,
        ]);
    }
}
