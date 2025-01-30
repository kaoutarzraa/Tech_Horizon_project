<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class MagazineController extends Controller
{
    
    public function index()
    {
        $issues = Issue::all();
        return view('Editeur.MagazineIssue', compact('issues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('issues', 'public');

        Issue::create([
            'title' => $request->title,
            'cover_image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Issue créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required|string',
        ]);

        $issue = Issue::findOrFail($id);
        $imagePath = $issue->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('issues', 'public');
        }
        $issue->update([
            'title' => $request->title,
            'cover_image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Issue mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect()->back()->with('success', 'Issue supprimée avec succès.');
    }
}
