<?php

namespace App\Policies;

use App\Answer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    // Énumère qui peut modifier une réponse
    public function update(User $user, Answer $answer) {
        return $user->id === $answer->user_id;                              // Seulement l'auteur de la réponse 
    }

    // Énumère qui peut supprimer une réponse
    public function delete(User $user, Answer $answer) {
        return $user->id === $answer->user_id;                              // Seulement l'auteur de la réponse
    }

    // Énumère qui peut accepter la meilleur réponse
    public function accept(User $user, Answer $answer) {
        return $user->id === $answer->question->user_id;                    // Seulement l'auteur de la question
    }
}
