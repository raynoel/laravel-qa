<?php

namespace App\Policies;

use App\Question;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /* Défini quel usagés peuvent modifier le model */
    public function update(User $user, Question $question)
    {
        return $user->id === $question->user_id;
    }


    /* Défini quel usagés peuvent supprimer le model */
    public function delete(User $user, Question $question)
    {
        return $user->id === $question->user_id && $question->answers_count < 1;
    }

    
}
