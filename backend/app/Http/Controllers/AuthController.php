<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|string|max:20',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|string|min:8|confirmed'
        ]);

        $validate['id_user'] = Str::uuid();
        $validate['password'] = Hash::make($validate['password']);

        $user = User::create($validate);

        $token = $user->createToken('BearerToken')->plainTextToken;

        return response($token, 200);
    }
}
