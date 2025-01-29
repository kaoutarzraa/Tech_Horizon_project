<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Article;
use App\Models\Theme;

// Route pour la page d'accueil (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// Routes d'authentification
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['role:invite'])->group(function () {
    Route::get('/getArticles/byThemeId/{id}', [ArticleController::class, 'getArticleByThemeId']);
    Route::get('/theme/{id}', [ThemeController::class, 'show'])->name('theme.show');
    Route::get('/subscribe/{themeId}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::get('/subscriptions', [SubscriptionController::class, 'manageSubscriptions'])->name('subscriptions');
    Route::get('/subscription/changeStatusToExpire/{id}', [SubscriptionController::class, 'changeStatusToExpire'])->name('changeStatusToExpire');
    Route::get('/manageArticles/bySubscriber', [ArticleController::class, 'getAllArticlesByUserId'])->name('getAllArticlesByUserId');
    Route::post('/manageArticles/bySubscriber/create', [ArticleController::class, 'create'])->name('createArticle');
    Route::put('/manageArticles/bySubscriber/update/{id}', [ArticleController::class, 'update'])->name('updateArticle');
    Route::delete('/manageArticles/bySubscriber/delete/{id}', [ArticleController::class, 'destroy'])->name('deleteArticle');
});
Route::middleware(['role:responsable'])->group(function () {
    Route::get('/dashboard/responsable/themes', [ThemeController::class, 'getAllThemesByUserId'])->name('getAllThemesByUserId');
    Route::get('/dashboard/responsable/superviseArticles/{id}', [ThemeController::class, 'superviseArticles'])->name('superviseArticles');
    Route::get('/dashboard/responsable/reviewArticles', [ArticleController::class, 'getAllArticleToResponsable'])->name('getAllArticleToResponsable');
    Route::get('/dashboard/responsable/subscriptions/{id}', [ThemeController::class, 'manageSubscriptions'])->name('manageSubscriptions');
    Route::get('/subscription/changeStatusToExpire/{id}', [SubscriptionController::class, 'changeStatusToExpire'])->name('changeStatusToExpire');

});


Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');