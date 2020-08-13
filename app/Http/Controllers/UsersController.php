<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Affiche un usagé
    public function show(User $user) {
        return view('auth.show', compact('user'));
    }

}
