<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use App\Models\Block;
use App\Models\World;
>>>>>>> 77b848ea9113eda578673a81d2df7ee5e88d0352
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
<<<<<<< HEAD
        return view('home');
=======
        $blocks = Block::all();

        $world = auth()->user()->worlds()->latest()->first();

        return view('home', [
            'blocks' => $blocks,
            'world' => $world,
        ]);
>>>>>>> 77b848ea9113eda578673a81d2df7ee5e88d0352
    }
}
