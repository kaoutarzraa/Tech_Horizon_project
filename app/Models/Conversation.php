<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    // Spécifie le nom de la table associée
    protected $table = 'conversations';

    // Spécifie la clé primaire
    protected $primaryKey = 'conversation_id';

    // Désactive les timestamps car la table utilise `created_at` comme date
    public $timestamps = false;

    // Définir les colonnes qui peuvent être remplies par l'utilisateur
    protected $fillable = [
        'article_id',
        'status',
        'created_at',
    ];

    // Définir la relation avec le modèle Article
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }
}
