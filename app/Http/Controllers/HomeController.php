<?php

namespace App\Http\Controllers;

use App\Models\World;
class HomeController extends Controller
{
    public function index(){
        return view('home', [
            'hasworld' => World::where('user_id', auth()->user()->id)->exists()
        ]);
    }
}
