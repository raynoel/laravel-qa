<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    /* Affiche toutes les questions */
    public function index() 
    {
        $questions = Question::with('user')->latest()->paginate(5);  # with() lazy-load la table 'User'. Prévient de faire 50 queries sur la table 'User'
        return view('questions.index', compact('questions'));
    }


    /* Formulaire pour ajouter 1 question */
    public function create()
    {
        $question = new Question();
        $user = Auth::user();
        return view('questions.create', compact('question', 'user'));
    }


    /* Valide et enregistre 1 nouvelle question */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'user_id' => 'required'
        ]);
 
        Question::create($data);

        return redirect()->route('questions.index')->with('success', 'Your question has been submitted');
    }


    /* Affiche 1 question */
    public function show(Question $question)
    {
        //
    }


    /* Formulaire pour modifier une question */
    public function edit(Question $question) {
        $user = Auth::user();
        return view('questions.edit', compact('question', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $data = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'user_id' => 'required'
        ]);
        $question->update($data);
        return redirect()->route('questions.index')->with('success', 'Your question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
