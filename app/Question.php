<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];                        // Accepte tous les params pour ajouter une rangée dans la DB

    # Tables relationnelles
    # Dans la table 'questions' on a un champ contenant une clé étrangère vers une table 'users'
    public function user() {
        return $this->belongsTo(\App\User::class);                  // Une question appartient à 1 usagé
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);               // Converti le titre en slug
    }

    public function getUrlAttribute() {                             // Retourne la variable $question->url
        return route('questions.show', $this->id);
    }

    public function getCreatedDateAttribute() {                     // Retourne la variable $question->created_date
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {                          // Retourne la variable $question->status
        if ($this->answers > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
}