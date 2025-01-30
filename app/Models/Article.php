<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Spécifie la table associée au modèle
    protected $table = 'articles';

    // Clé primaire
    protected $primaryKey = 'id';

    // Attributs qui peuvent être assignés en masse
    protected $fillable = [
        'title', 'content', 'theme_id', 'image_url',  'issue_id', 'author_id', 
        'status', 'submission_date', 'publication_date', 'is_active'
    ];

    // Relation avec le thème (un article appartient à un thème)
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }

    // Relation avec l'auteur (un article appartient à un auteur)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Relation avec les images de l'article (un article peut avoir plusieurs images)
    public function images()
    {
        return $this->hasMany(ArticleImage::class, 'article_id');
    }

    // Fonction pour ajouter une image à l'article
    public function addImage(array $imageData)
    {
        return $this->images()->create($imageData);
    }

    // Fonction pour changer le statut de l'article
    public function changeStatus(string $status)
    {
        return $this->update(['status' => $status]);
    }

    // Fonction pour marquer un article comme "publié"
    public function publishArticle()
    {
        return $this->update([
            'status' => 'publie',
            'publication_date' => now()
        ]);
    }

    // Vous pouvez également ajouter d'autres méthodes utiles comme:
    // - Fonction pour vérifier si l'article est publié
    public function isPublished()
    {
        return $this->status === 'publie';
    }

    // Fonction pour activer ou désactiver un article
    public function toggleActiveStatus()
    {
        $this->is_active = !$this->is_active;
        return $this->save();
    }
}