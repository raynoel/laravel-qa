<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $guarded = [];                                          // Permet le mass assignement. Ok si Controller::store() valide les champs

  public function question() {
      return $this->belongsTo(Question::class);                     // Une réponse appartient à une question
  }


  public function user() {
      return $this->belongsTo(\App\User::class);                    // Une réponse appartient à 1 usagé
  }


  public function getBodyHtmlAttribute()  {
      return \Parsedown::instance()->text($this->body);             // Retourne le texte converti en HTML 
  }


  public function getCreatedDateAttribute() {
      return $this->created_at->diffForHumans();                    // Converti 'created_at' en format humanisé
  }


  public function getStatusAttribute() {                            // $answer->status retourne 'vote-accepted'
    return $this->id === $this->question->best_answer_id ? 'vote-accepted' : '';
  }


  public static function boot() {                                   // Fonction exécutée lorsqu'on ajoute une rangée dans le tableau Answer
    parent::boot();

    static::created(function ($answer) {
      $answer->question->increment('answers_count');                // Augmente le champ Question['answer_count'] de la question relative à la réponse
    });

    static::deleted(function ($answer) {
      $answer->question->decrement('answers_count');                // Décroit le champ Question['answer_count'] de la question relative à la réponse
      $question = $answer->question;
      if ($question->best_answer_id === $answer->id) {              // Efface la valeur de Question['best_answer_id']
          $question->best_answer_id = NULL;
          $question->save();
      }
    });
  }


}
