<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];                        // Accepte tous les params pour ajouter une rangée dans la DB

    # Tables relationnelles
    # Dans la table 'questions' on a un champ contenant une clé étrangère vers une table 'users'
    public function user() {
        return $this->belongsTo(User::class);      // Indique que 'user' réfère à la table 'User'
    }


}
