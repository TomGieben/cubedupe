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
}
