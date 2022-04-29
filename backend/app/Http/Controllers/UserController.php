<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return User::where('id', Auth::user()->id)->delete();
    }

    public function getUserUUID()
    {
        return User::where('id', Auth::user()->id)->pluck('id_user')->first();
    }
}
