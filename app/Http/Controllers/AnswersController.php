<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

use Illuminate\Http\Request;

class AnswersController extends Controller
{

    // Enregistre une réponse 
    public function store(Question $question, Request $request) {                           // La route update contient questions['id'] et answers['id']... pour accéder aux models, on doit les passer en param
        $data = $request->validate([
            'body' => 'required',
        ]);
        $data['user_id'] = \Auth::id();
        $question->answers()->create($data);

        return back()->with('success', "Your answer has been submitted successfully");
    }   


    // Formulaire pour modifier une réponse
    public function edit(Question $question, Answer $answer)  {
        $this->authorize('update', $answer);                                                // Utilise les restrictions définies dans App/policies/AnswerPolicy::update()
        return view('answers.edit', compact('question', 'answer'));
    }

    // Modifie une réponse
    public function update(Request $request, Question $question, Answer $answer) {          // La route update contient questions['id'] et answers['id']... pour accéder aux models, on doit les passer en param
        $this->authorize('update', $answer);                                                // Utilise les restrictions définies dans App/policies/AnswerPolicy::update()
        
        $answer->update($request->validate([
            'body' => 'required',
        ]));
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated');
    }


    // Supprime une réponse
    public function destroy(Question $question, Answer $answer) {
        $this->authorize('delete', $answer);
        $answer->delete();
        return back()->with('success', 'Your answer has been removed');
    }

    
}
