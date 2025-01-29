<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewStatistic extends Model
{
    use HasFactory;

    // Définir le nom de la table si elle ne suit pas la convention
    protected $table = 'viewstatistics';

    // Définir la clé primaire si elle n'est pas 'id'
    protected $primaryKey = 'stat_id';

    // Si tu utilises des dates personnalisées pour la création et la mise à jour
    // protected $dates = ['created_at', 'updated_at'];

    // Définir les colonnes qui peuvent être modifiées
    protected $fillable = [
        'article_id',
        'theme_id',
        'view_count',
        'last_updated',
    ];

    // Si tu ne veux pas gérer les colonnes timestamps automatiquement
    // public $timestamps = false;

    /**
     * Relation avec le modèle Article
     * Un ViewStatistic appartient à un Article
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * Relation avec le modèle Theme
     * Un ViewStatistic appartient à un Theme
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }

    /**
     * Fonction pour augmenter le nombre de vues d'un article
     */
    public function incrementViewCount()
    {
        $this->view_count += 1;
        $this->save();
    }

    /**
     * Fonction pour réinitialiser le nombre de vues
     */
    public function resetViewCount()
    {
        $this->view_count = 0;
        $this->save();
    }

    /**
     * Fonction pour mettre à jour la date de la dernière vue
     */
    public function updateLastViewed()
    {
        $this->last_updated = now();
        $this->save();
    }
}
