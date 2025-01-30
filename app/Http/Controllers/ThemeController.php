<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Article;
use App\Models\Conversation;
use App\Models\Discussion;
use App\Models\Statistic;
use App\Models\ThemeSubscription;
use App\Models\ViewStatistic;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    // Gérer les abonnements de son thème
    public function manageSubscriptions($themeId)
    {
        $subscriptions = ThemeSubscription::where('theme_id', $themeId)->where('status' , '!=' , 'expire')->get();
        return view('Responsable.ManageSuscriptions', compact('subscriptions'));
    }

    public function getAllThemesByUserId(){
        $themes = Theme::where('responsable_id', Auth::id())->get();
        return view('Responsable.ManageThemes' , compact('themes'));

    }

    // Superviser les articles publiés dans son thème
    public function superviseArticles($themeId)
    {
        $articles = Article::where('theme_id', $themeId)->where('status', 'publie')->get();
        return view('Responsable.SuperviseArticle', compact('articles'));
    }

    // Examiner les articles soumis par les abonnés et décider de leur publication
    public function reviewArticles($themeId)
    {
        $submittedArticles = Article::where('theme_id', $themeId)->where('status', 'submitted')->get();
        return view('theme.review_articles', compact('submittedArticles'));
    }

    public function publishArticle($articleId)
    {
        $article = Article::find($articleId);
        $article->status = 'publie';
        $article->save();
        return redirect()->back()->with('success', 'Article published successfully.');
    }

    public function rejectArticle($articleId)
    {
        $article = Article::find($articleId);
        $article->status = 'refuse';
        $article->save();
        return redirect()->back()->with('success', 'Article rejected successfully.');
    }

    public function viewStatistics($themeId)
    {
        $articleStats = ViewStatistic::where('theme_id', $themeId)->where('type', 'article')->get();
        $subscriptionStats = ViewStatistic::where('theme_id', $themeId)->where('type', 'subscription')->get();
        return view('theme.statistics', compact('articleStats', 'subscriptionStats'));
    }

    public function moderateDiscussions($themeId)
    {
        $discussions = Conversation::where('theme_id', $themeId)->get();
        return view('theme.discussions', compact('discussions'));
    }

    public function deleteDiscussion($discussionId)
    {
        $discussion = Conversation::find($discussionId);
        $discussion->delete();
        return redirect()->back()->with('success', 'Discussion deleted successfully.');
    }

    public function getAllThemes(){
        $allThemes = Theme::all();
        return $allThemes;
    }
}