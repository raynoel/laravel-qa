<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    public function questions() {
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
}
