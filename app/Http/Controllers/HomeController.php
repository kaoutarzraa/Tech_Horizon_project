<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller 
{
    public function index() 
    {
        if (!Auth::check()) {
            return redirect()->route('/');
        }
        
        $themes = Theme::all();
        return view('auth.home', compact('themes'));
    }

    public function welcome()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('welcome');
    }
}