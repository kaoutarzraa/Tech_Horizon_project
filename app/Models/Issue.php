<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    // Spécifie le nom de la table associée
    protected $table = 'issues';

    // Spécifie la clé primaire
    protected $primaryKey = 'issue_id';

    // Désactive les timestamps car la table utilise `created_at` et `updated_at` manuellement si besoin
    public $timestamps = false;

    // Définir les colonnes qui peuvent être remplies par l'utilisateur
    protected $fillable = [
        'title',
        'publication_date',
        'status',
        'cover_image',
        'description',
    ];

    // Accessor pour obtenir la date au format désiré si besoin
    protected $dates = ['publication_date'];
}
