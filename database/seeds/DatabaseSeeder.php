<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Commande effectuée pour générer les données dans la DB
        factory(App\User::class, 3)->create()                                                           // Cré 3 usagés 
            ->each(function ($new_user) {
                $new_user->questions()->saveMany(factory(App\Question::class, 5)->make()                // Cré 5 questions
            )
            ->each(function ($new_question) {
                $new_question->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());     // Cré 1-5 réponse
            });
        });
    }
}
