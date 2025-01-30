<?php

namespace App\Http\Controllers;

use App\Models\ThemeSubscription;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:abonne,responsable',
        ]);

        $user = new User();
        $user->username = $validatedData['username'];
        $user->full_name = $validatedData['full_name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->password = bcrypt('TheckHorizons2025');
        $user->save();
        if($validatedData['role'] == 'abonne'){
            $themeSubscription = new ThemeSubscription();
            $themeSubscription->user_id = $user->id;
            $themeSubscription->theme_id = $user->id;
            $themeSubscription->save();
        }

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function update(Request $request , $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|in:abonne,responsable',
        ]);

        $user = User::findOrFail($id);
        $user->username = $validatedData['username'];
        $user->full_name = $validatedData['full_name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->password = bcrypt('TheckHorizons2025');
        $user->save();
        if($validatedData['role'] == 'abonne'){
            $themeSubscription = new ThemeSubscription();
            $themeSubscription->user_id = $user->id;
            $themeSubscription->theme_id = $user->id;
            $themeSubscription->save();
        }

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
    
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->status = "bloque";
        $user->save();

        return redirect()->back()->with('success', 'User blocked successfully.');
    }
}