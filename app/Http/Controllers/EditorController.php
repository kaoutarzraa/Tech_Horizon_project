<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Theme;

class EditorController extends Controller
{
    // Affichage du tableau de bord de l'éditeur
    public function dashboard()
    {
        // Récupérer tous les articles
        $articles = Article::all();

        // Récupérer tous les utilisateurs
        $users = User::all();

        // Calculer des statistiques
        $stats = [
            'numArticles' => Article::count(),
            'numUsers' => User::count(),
            'numThemeManagers' => User::where('role', 'responsable')->count(),
            'numThemes' => Theme::count(),
        ];

        // Retourner la vue avec les articles, utilisateurs et statistiques
        return view('auth.editor.dashboard', compact('articles', 'users', 'stats'));
    }

    // Publier un article
    public function publishArticle($article_id)
    {
        // Récupérer l'article par son ID
        $article = Article::findOrFail($article_id);

        // Mettre à jour le statut de l'article
        $article->status = 'publie';
        $article->save();

        // Rediriger vers le tableau de bord de l'éditeur
        return redirect()->route('editor.dashboard');
    }

    // Rendre public un article
    public function makePublicArticle($article_id)
    {
        // Récupérer l'article par son ID
        $article = Article::findOrFail($article_id);

        // Mettre à jour le statut de l'article
        $article->status = 'public';
        $article->save();

        // Rediriger vers le tableau de bord de l'éditeur
        return redirect()->route('editor.dashboard');
    }

    // Méthodes pour gérer les utilisateurs peuvent aussi être ajoutées ici...
}
