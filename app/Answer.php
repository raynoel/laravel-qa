<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  
  protected $guarded = [];                                        // Permet le mass assignement. Ok si Controller::store() valide les champs

  public function question() {
      return $this->belongsTo(Question::class);                   // Une réponse appartient à une question
  }


  public function user() {
      return $this->belongsTo(\App\User::class);                  // Une réponse appartient à 1 usagé
  }


  public function getBodyHtmlAttribute()  {
      return \Parsedown::instance()->text($this->body);             // Retourne le texte converti en HTML 
  }


  public function getCreatedDateAttribute() {
      return $this->created_at->diffForHumans();                    // Converti 'created_at' en 'create_date' 
  }

  
  public function getStatusAttribute() {                            // $answer->status retourne 'vote-acceted' si cette réponse est la meilleur réponse, qui affiche un crochet vert à coté de la réponse
    return $this->id === $this->question->best_answer_id ? 'vote-accepted' : '';
  }


  public function getIsBestAttribute() {                            // '$answer->is_best' retourne Vrai si cette réponse est la meilleur réponse
    return $this->id === $this->question->best_answer_id;
  }


  public static function boot() {                                   // Fonction exécutée lorsqu'on ajoute une rangée dans le tableau Answer 
    parent::boot();

    static::created(function ($answer) {
        $answer->question->increment('answers_count');              // Augmente le champ 'answer_count' de la table question
    });        

    static::deleted(function ($answer) {            
        $answer->question->decrement('answers_count');              // Décroit le champ 'answer_count' de la table question
    });
  }

}
