<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUser()
    {
        $id = Auth::user()->id;

        return User::where('id', $id)->get();
    }

    public function deleteUser()
    {
        Auth::user()->tokens()->delete();
        User::where('id', Auth::user()->id)->delete();

        return 'Utilisateur supprimé';
    }
}