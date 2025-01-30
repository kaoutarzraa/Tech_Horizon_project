<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use App\Models\Theme;

// Route pour la page d'accueil (welcome)
Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// Routes d'authentification
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/getArticles/byThemeId/{id}', [ArticleController::class, 'getArticleByThemeId']);

Route::middleware(['role:invite'])->group(function () {
    Route::get('/theme/{id}', [ThemeController::class, 'show'])->name('theme.show');
    Route::get('/subscribe/{themeId}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
});
Route::middleware(['role:abonne'])->group(function () {
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
    Route::get('/dashboard/responsable/rejectArticle/{id}', [ThemeController::class, 'rejectArticle'])->name('rejectArticle');
    Route::get('/dashboard/responsable/publishArticle/{id}', [ThemeController::class, 'publishArticle'])->name('publishArticle');
    Route::get('/dashboard/responsable/subscriptions/{id}', [ThemeController::class, 'manageSubscriptions'])->name('manageSubscriptions');
    Route::get('/subscription/changeStatusToExpire/{id}', [SubscriptionController::class, 'changeStatusToExpire'])->name('changeStatusToExpire');
    Route::get('/dashboard/responsable/statistics', [ArticleController::class, 'statisticsArticles'])->name('statisticsArticles');
    Route::post('/dashboard/responsable/themes/create', [ThemeController::class, 'store'])->name('storeTheme');
    Route::put('/dashboard/responsable/themes/update/{id}', [ThemeController::class, 'update'])->name('updateTheme');
    Route::delete('/dashboard/responsable/themes/delete/{id}', [ThemeController::class, 'destroy'])->name('deleteTheme');

});

Route::middleware(['role:editeur'])->group(function () {
    Route::get('/dashboard/editeur/board', [DashboardController::class, 'dashboard'])->name('board');
    Route::get('/dashboard/editeur/manage/users', [DashboardController::class, 'getAllUsers'])->name('getAllUsers');
    Route::post('/dashboard/editeur/manage/users/create', [UserController::class, 'create'])->name('createUsers');
    Route::put('/dashboard/editeur/manage/users/update/{id}', [UserController::class, 'update'])->name('updateUsers');
    Route::delete('/dashboard/editeur/manage/users/delete/{id}', [UserController::class, 'destroy'])->name('deleteUsers');
    Route::get('/dashboard/editeur/manage/users/bloque/{id}', [UserController::class, 'block'])->name('blockUsers');
    Route::get('/dashboard/editeur/statistices', [DashboardController::class, 'dashboard'])->name('board');
    Route::get('/dashboard/editeur/magazin', [MagazineController::class, 'index'])->name('magazinBoard');
    Route::post('/dashboard/editeur/magazin/create', [MagazineController::class, 'store'])->name('createMagazin');
    Route::put('/dashboard/editeur/magazin/update/{id}', [MagazineController::class, 'update'])->name('updateMagazin');
    Route::delete('/dashboard/editeur/magazin/delete/{id}', [MagazineController::class, 'destroy'])->name('deleteMagazin');

   

});


Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/Logout', [AuthController::class, 'logout'])->name('logout');