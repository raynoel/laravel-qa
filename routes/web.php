<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('questions', 'QuestionsController')->except('show');                // CRUD pour les questions
Route::get('questions/{slug}', 'QuestionsController@show')->name('questions.show'); // On veut que {slug} remplace {id}
// Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswersController')->except(['index', 'create', 'show']);

Route::get('/users/{user}', 'UsersController@show')->name('users.show');