<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name'=>'required|string|max:20',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|string|min:8|confirmed'
        ]);

        if($validate->fails()){
            return response()->json([
                $validate->errors()->all()
            ], 403);
        }

        /**
         * Gestion UUID et Hash mot de passe
         */
        $validate = $validate->getData();
        $validate['id_user'] = Str::uuid();
        $validate['password'] = Hash::make($validate['password']);

        $user = User::create($validate);

        $token = $user->createToken('BearerToken')->plainTextToken;

        return response(['Bearer Token' => $token]);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))) {
            return response(['Erreur' => 'Identifiants incorrects'], 401);
        }

        $user = User::where('email', '=', $request['email'])->firstOrFail();

        $token = $user->createToken('BearerToken')->plainTextToken;

        return response(['Bearer Token' => $token]);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return response('token destroyed');
    }
}
