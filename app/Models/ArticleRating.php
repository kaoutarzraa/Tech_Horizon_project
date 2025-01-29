<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleRating extends Model
{
    use HasFactory;

    // Spécifie le nom de la table associée
    protected $table = 'articleratings';

    // Spécifie la clé primaire
    protected $primaryKey = ['user_id', 'article_id'];

    // Pour indiquer que la clé primaire est composée de plusieurs colonnes, on définit la propriété suivante
    public $incrementing = false;

    // Désactive les timestamps si la table ne les utilise pas
    public $timestamps = false;

    // Définir les colonnes qui peuvent être remplies par l'utilisateur
    protected $fillable = [
        'user_id',
        'article_id',
        'rating',
        'rating_date',
    ];

    // Définir la relation avec le modèle Article
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }

    // Définir la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
