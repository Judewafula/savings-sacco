<?php

namespace App\Http\Controllers;

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
        $assets = [
            [
                'name' => 'Asset 1',
                'type' => 'Image',
                'url' => 'https://example.com/assets/image1.jpg',
            ],
            [
                'name' => 'Asset 2',
                'type' => 'Video',
                'url' => 'https://example.com/assets/video1.mp4',
            ],
            // Add more assets as needed
        ];

        return view('home')->with('assets', $assets);
    }
}




       
