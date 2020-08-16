<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Question;
use App\Answer;
use App\Policies\QuestionPolicy;
use App\Policies\AnswerPolicy;

class AuthServiceProvider extends ServiceProvider
{
    // Indique quel classe utiliser pour vérifier les restrictions d'accès
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Question::class => QuestionPolicy::class,
        Answer::class => AnswerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
