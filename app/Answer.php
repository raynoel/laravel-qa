<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    public function question() {
        return $this->belongsTo(Question::class);                   // Une réponse appartient à une question
    }


    public function user() {
        return $this->belongsTo(\App\User::class);                  // Une réponse appartient à 1 usagé
    }


    public function getBodyHtmlAttribute()  {
        return \Parsedown::instance()->text($this->body);          // Retourne le texte converti en HTML 
    }


    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();                 // Converti 'created_at' en 'create_date' 
    }

    

    public static function boot() {                                // Fonction exécutée lorsqu'on ajoute une rangée dans le tableau Answer
        parent::boot();
        static::created(function ($answer) {
            // Obtient la question correspondant à 'quesion_id' de $answer et incrémente son champ 'answer_count'
            $answer->question->increment('answers_count');  
        });
    }
}
