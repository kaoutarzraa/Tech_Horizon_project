<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    use HasFactory;

    protected $table = 'articleimages';
    protected $primaryKey = 'image_id';

    protected $fillable = ['article_id', 'image_url', 'caption', 'display_order'];

    // Relation avec l'article
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    // Fonction pour ajouter une image
    public static function addImageToArticle($articleId, $data)
    {
        $data['article_id'] = $articleId;
        return self::create($data);
    }

    // Fonction pour supprimer une image
    public function deleteImage()
    {
        return $this->delete();
    }
}
