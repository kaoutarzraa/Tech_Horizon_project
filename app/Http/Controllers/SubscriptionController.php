<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Theme;
use App\Models\ThemeSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Show the subscription page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('subscribe');
    }

    /**
     * Handle subscription form submission.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function subscribe($id)
    {
        try {
            // Validate that the theme exists
            $theme = Theme::findOrFail($id);

            // Prevent the user from subscribing to the same theme again
            if (ThemeSubscription::where('theme_id', $id)->where('user_id', Auth::id())->exists()) {
                return redirect()->back()->with('warning', 'Vous êtes déjà abonné à ce thème.');
            }


            // Create the subscription
            ThemeSubscription::create([
                'user_id' => Auth::id(),
                'theme_id' => $id,
            ]);

            $articles = Article::where('is_active', true)->where('theme_id', $id)->latest()->get();
            
            $user = User::find(Auth::id());
            if ($user) {
                $user->update(['role' => 'abonne']);
            }
            
            return redirect()->back()->with('success', 'Vous êtes maintenant abonné au thème "' . $theme->name . '" !')->with('articles' , $articles);

        } catch (\Exception $e) {
            // Catch any exceptions and return an error message
            return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.' . $e);
        }
    }

    public function manageSubscriptions(){
        $subscriptions = ThemeSubscription::where('user_id', Auth::id())->where('status', '!=', 'expire')->get();
        return view('Subscriptions.ManageSubscriptions' , compact('subscriptions'));
    }

    public function changeStatusToExpire($id){  
        $subscription = ThemeSubscription::where('theme_id', $id)->where('user_id', Auth::id())->firstOrFail();
        $subscription->status = 'expire';
        $subscription->save();
        return redirect()->back()->with('success', 'L\'abonnement a été marqué comme expiré avec succès.');
    }
}