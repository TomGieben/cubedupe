<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\World;
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
        $world = auth()->user()->worlds()->latest()->first() ?? abort('404');

        return view('home', [
            'world' => $world,
        ]);
    }

    public function save(Request $request) {
        $world = auth()->user()->worlds()->latest()->first();

        $world->update([
            'html' => $request->html,
        ]);

        return true;
    }

    public function item(Request $request) {
        return Item::getData($request->item);
    }
}
