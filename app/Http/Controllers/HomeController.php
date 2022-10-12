<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blocks = Block::all();

        return view('home', [
            'blocks' => $blocks,
        ]);
    }
}
