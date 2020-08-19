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

    public function answers() {
        return $this->hasMany(Answer::class);                       // Une question possède plusieurs réponses
    }

    public function setTitleAttribute($value) {                     // Déclenché lorsqu'on essaie d'enregistrer le champ 'titre'
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \Str::slug($value . time());    // Converti le titre en slug unique
    }


    public function getUrlAttribute() {                             // Retourne la variable '$question->url'
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute() {                     // Retourne la variable '$question->created_date'
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {                          // Retourne la variable '$question->status'
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute()  {
        return \Parsedown::instance()->text($this->body);          // Retourne le texte converti en HTML dans '$question->body_html'
    }

    public function acceptBestAnswer(Answer $answer) {
        $this->best_answer_id = $answer->id;
        $this->save();

    }




}