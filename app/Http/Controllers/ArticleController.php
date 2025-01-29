<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Issue;
use App\Models\Theme;
use App\Models\ThemeSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Afficher la page d'accueil avec les articles et les thèmes
    public function getArticleByThemeId($id)
    {
        $subsribeCheck = ThemeSubscription::where('theme_id', $id)->where('user_id' , Auth::id())->exists();
        $themes = Theme::all();

        if($subsribeCheck){

            $articles = Article::where('is_active', true)->where('theme_id', $id)->latest()->get();
            return view('articles.ArticlesPage' , compact('themes' , 'articles' , 'id'));
        }

        $articles = Article::where('is_active', true)->where('theme_id', $id)->latest()->take(2)->get();
        return view('articles.ArticlesPage' , compact('themes' , 'articles' , 'id'));
    }

    public function getAllArticlesByUserId(){
        $articles = Article::where('author_id', Auth::id())->get();
        $themes = Theme::all();
        $issues = Issue::all();
        return view('Subscriptions.ManageArticles', compact('articles' , 'themes' , 'issues'));
    }

    public function getAllArticleToResponsable(){
        $themes = Theme::where('responsable_id' , Auth::id())->get();
        $articles = Article::whereIn('theme_id', $themes->pluck('id'))->where('status' , 'en_cours')->get();

        return view('Responsable.ReviewArticles', compact('articles'));
    }


    // Afficher un article spécifique
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }
    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'theme_id' => 'required|exists:themes,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        
    
        if ($request->hasFile('image')) { 
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            
            $image->move(public_path('Uploads'), $imageName);
            
            $validatedData['image_url'] = 'Uploads/' . $imageName;
            
        } else {
            $validatedData['image_url'] = 'default.jpg';
        }
    
        $validatedData['author_id'] = Auth::id();
        $validatedData['issue_id'] = $request->input('issue_id'); // Store issue_id if selected
    
        Article::create($validatedData);
    
        return redirect()->back()->with('success', 'Article créé avec succès.');
    }
    
    

    // Modifier un article existant
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $themes = Theme::all();

        return view('articles.edit', compact('article', 'themes'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'theme_id' => 'required|exists:themes,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        // Find the article to update
        $article = Article::findOrFail($id);
    
        // Handle image upload if a new file is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
    
            // Move the uploaded file to the public/Uploads directory
            $image->move(public_path('Uploads'), $imageName);
    
            // Update the image_url in the validated data
            $validatedData['image_url'] = 'Uploads/' . $imageName;
    
            // Optionally, delete the old image file if it exists
            if ($article->image_url && file_exists(public_path($article->image_url))) {
                unlink(public_path($article->image_url));
            }
        } else {
            // Retain the existing image_url if no new file is uploaded
            $validatedData['image_url'] = $article->image_url;
        }
    
        // Update the article with the validated data
        $article->update($validatedData);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Article mis à jour avec succès.');
    }

    // Supprimer un article
    public function destroy($id)
    {
        // Find the article by its ID
        $article = Article::findOrFail($id);
    
        // Check if the article has an associated image and delete it from the server
        if ($article->image_url && file_exists(public_path($article->image_url))) {
            unlink(public_path($article->image_url));
        }
    
        // Delete the article from the database
        $article->delete();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Article supprimé avec succès.');
    }
}
