<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{

    // Single action controlleur
    public function __invoke(Answer $answer) {
        // dd('You accepted this answer');
        $this->authorize('accept', $answer);                                // Vérifie si l'usagé est l'auteur de la question
        $answer->question->acceptBestAnswer($answer);                       // Appel une fct de la classe Question qui enregistre le id de la réponse dans le tableau de la question
        return back();                                                      // Reste sur la page appelante
    }

}
