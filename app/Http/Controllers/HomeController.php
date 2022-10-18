<?php

namespace App\Http\Controllers;

use App\Models\World;

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
        $world = auth()->user()->worlds()->latest()->first();

        return view('home', [
            'hasworld' => $world,
        ]);
    }
}
