<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $themeController;

    public function __construct(ThemeController $themeController)
    {
        $this->themeController = $themeController;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'full_name' => 'required|string|max:255',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'full_name' => $validated['full_name'],
            'role' => 'invite',
        ]);

        Auth::login($user);

        $allThemes = $this->themeController->getAllThemes();

        return redirect()->route('home')->with('themes', $allThemes);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/');
    }

    public function showTheme($id)
    {
        return view('theme.show', ['theme' => Theme::findOrFail($id)]);
    }

    public function showSubscription()
    {
        return view('subscribe');
    }
}
