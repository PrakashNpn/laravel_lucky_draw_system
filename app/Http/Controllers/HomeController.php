<?php

namespace App\Http\Controllers;
use App\Models\Prize;

class HomeController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $prizes = Prize::all() ;
        return view('home', compact( 'prizes' ) ) ;
    }

}
