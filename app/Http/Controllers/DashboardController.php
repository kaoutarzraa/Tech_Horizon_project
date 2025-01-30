<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $abonneCount = User::where('role', 'abonne')->count();
        $responsableCount = User::where('role', 'responsable')->whereHas('themes')->count();
        $articleCount = Article::count();

        return view('Editeur.Dashboard', compact('abonneCount', 'responsableCount', 'articleCount'));
    }

    public function getAllUsers()
    {
        $usersAbonne = User::where('role', 'abonne')->whereHas('themeSubscriptions')->get();
        $usersResponable = User::where('role', 'responsable')->whereHas('themes')->get();
        $allThemes = Theme::all();
        return view('Editeur.ManageUsers', compact('allThemes' ,'usersAbonne', 'usersResponable'));
    }
}