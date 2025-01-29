<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrowsingHistory extends Model
{
    use HasFactory;

    // Spécifie le nom de la table associée
    protected $table = 'browsinghistory';

    // Spécifie la clé primaire
    protected $primaryKey = 'history_id';

    // Désactive les timestamps si la table ne les utilise pas, mais ici, on a 'viewed_at'
    public $timestamps = false;

    // Définir les colonnes qui peuvent être remplies par l'utilisateur
    protected $fillable = [
        'user_id',
        'article_id',
        'viewed_at',
    ];

    // Définir la relation avec le modèle Article
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }

    // Définir la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
