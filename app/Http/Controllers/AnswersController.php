<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

use Illuminate\Http\Request;

class AnswersController extends Controller
{

    // Enregistre une réponse dans la DB
    public function store(Question $question, Request $request)
    {
        $data = $request->validate([
            'body' => 'required'
        ]) + ['user_id' => \Auth::id()];
        $question->answers()->create($data);

        return back()->with('success', "Your answer has been submitted successfully");
    }   


}
