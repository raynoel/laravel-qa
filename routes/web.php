<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsController')->except('show');                // CRUD pour les questions
Route::get('questions/{slug}', 'QuestionsController@show')->name('questions.show'); // On veut que {slug} remplace {id}

Route::resource('questions.answers', 'AnswersController')->only(['store', 'edit', 'update', 'destroy']);
// Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
// Route::get('/questions/{question}/answers/{answer}/edit', 'AnswersController@edit')->name('answers.edit');
// Route::delete('/questions/{question}/answers/{answer}', 'AnswersController@destroy')->name('answers.stodestroyre');

Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept'); // Appel un single action controller

Route::get('/users/{user}', 'UsersController@show')->name('users.show');            // Affiches les infos d'un usagé