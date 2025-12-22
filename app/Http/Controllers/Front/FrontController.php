<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.home');
    }

    public function about()
    {
        return view('front.about');
    }
}
