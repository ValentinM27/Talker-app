<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import des controleurs
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// POST /api/auth/register : Permet de créér un compte
Route::post('/auth/register', [AuthController::class, 'register']);
// POST /api/auth/login : Permet de se connecter
Route::post('/auth/login', [AuthController::class, 'login']);

/**
 * Contient toutes les routes authentifiées
 */
Route::middleware('auth:sanctum')->group(function() {
    // POST /api/auth/logout : Permet de se déconnecter
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // GET /api/user : Permet de récupérer les données de l'utilisateur
    Route::get('user', [UserController::class, 'getUser']);
    // DELETE /api/user : Permet de supprimer son compte
    Route::delete('user', [UserController::class, 'deleteUser']);
});
