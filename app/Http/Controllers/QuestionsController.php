<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

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
        return view('questions.create', compact('question'));
    }


    /* Valide et enregistre 1 nouvelle question */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        Question::create($data);
        return back();
    }


    /* Affiche 1 question */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
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
        //
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
