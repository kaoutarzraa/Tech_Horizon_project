<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false; // Désactive les timestamps

    protected $fillable = [
        'username',
        'password',
        'email',
        'full_name',
        'role', 
        'status',
        'created_at',
        'last_login',
    ];

    protected $hidden = [
        'password',
    ];

    // Ajout de la méthode boot pour définir un rôle par défaut "invite" si aucune valeur n'est fournie
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Si le rôle n'est pas spécifié, on l'assigne à "invite"
            if (!$user->role) {
                $user->role = 'invite';
            }
        });
    }

    public function activateUser()
    {
        $this->status = 'actif';
        $this->save();
    }

    public function blockUser()
    {
        $this->status = 'bloque';
        $this->save();
    }

    public function setUserWaiting()
    {
        $this->status = 'en_attente';
        $this->save();
    }

    public function themeSubscriptions()
    {
        return $this->hasMany(ThemeSubscription::class, 'user_id', 'id');
    }

    public function articleRatings()
    {
        return $this->hasMany(ArticleRating::class, 'user_id', 'id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'user_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }

    public function isSubscribedToTheme($themeId)
    {
        return $this->themeSubscriptions()->where('theme_id', $themeId)->exists();
    }

    public function isEditor()
    {
        return $this->role === 'editeur';
    }

    public function isSubscriber()
    {
        return $this->role === 'abonne';
    }

    public function isResponsible()
    {
        return $this->role === 'responsable';
    }

    public function authoredArticles()
    {
        return $this->hasMany(Article::class, 'author_id', 'id');
    }

    public function activeSubscriptions()
    {
        return $this->themeSubscriptions()->where('status', 'actif')->count();
    }
}
