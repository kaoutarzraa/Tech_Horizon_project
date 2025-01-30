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
        $articles = Article::whereIn('theme_id', $themes->pluck('id'))->where('status' , 'propose')->get();

        return view('Responsable.ReviewArticles', compact('articles'));
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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'theme_id' => 'required|exists:themes,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        $article = Article::findOrFail($id);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
    
            $image->move(public_path('Uploads'), $imageName);
    
            $validatedData['image_url'] = 'Uploads/' . $imageName;
    
            if ($article->image_url && file_exists(public_path($article->image_url))) {
                unlink(public_path($article->image_url));
            }
        } else {

            $validatedData['image_url'] = $article->image_url;
        }
    
        $article->update($validatedData);
    
        return redirect()->back()->with('success', 'Article mis à jour avec succès.');
    }

    // Supprimer un article
    public function destroy($id)
    {
        
        $article = Article::findOrFail($id);
        
        if ($article->image_url && file_exists(public_path($article->image_url))) {
            unlink(public_path($article->image_url));
        }
        
        $article->delete();
    
        return redirect()->back()->with('success', 'Article supprimé avec succès.');
    }

    public function statisticsArticles(){
        $themes = Theme::where('responsable_id' , Auth::id())->get();
        $articlesCount = Article::whereIn('theme_id', $themes->pluck('id'))->count();
        $articlesPublishedCount = Article::whereIn('theme_id', $themes->pluck('id'))->where('status', 'publie')->count();
        $articlesPendingCount = Article::whereIn('theme_id', $themes->pluck('id'))->where('status', 'propose')->count();
        $subscriptionsCount = ThemeSubscription::whereIn('theme_id', $themes->pluck('id'))->count();
        $subscriptionsActiveCount = ThemeSubscription::whereIn('theme_id', $themes->pluck('id'))->where('status', 'actif')->count();
        $subscriptionsExpireCount = ThemeSubscription::whereIn('theme_id', $themes->pluck('id'))->where('status', 'expire')->count();

        return view('Responsable.ViewStatistics' , compact('articlesCount' , 'articlesPublishedCount' , 'articlesPendingCount' , 'subscriptionsCount' , 'subscriptionsActiveCount' , 'subscriptionsExpireCount'));
    }

}
