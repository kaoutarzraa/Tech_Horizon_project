<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $table = 'themes';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'description', 'responsable_id'];

    // Relation avec les articles
    public function articles()
    {
        return $this->hasMany(Article::class, 'id');
    }

    // Relation avec le responsable (User)
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    // Fonction de gestion pour ajouter un article
    public function addArticle($data)
    {
        return $this->articles()->create($data);
    }

    // Fonction de gestion pour mettre à jour les détails d'un thème
    public function updateDetails($data)
    {
        return $this->update($data);
    }

    // Fonction de gestion pour supprimer un thème
    public function deleteTheme()
    {
        return $this->delete();
    }
}
