<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import des controleurs
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;

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

/*
|--------------------------------------------------------------------------
| Auth controller
|--------------------------------------------------------------------------
*/
// POST /api/auth/register : Permet de créér un compte
Route::post('/auth/register', [AuthController::class, 'register']);
// POST /api/auth/login : Permet de se connecter
Route::post('/auth/login', [AuthController::class, 'login']);

/**
 * Contient toutes les routes authentifiées
 */
Route::middleware('auth:sanctum')->group(function() {
    /*
    |--------------------------------------------------------------------------
    | Auth controller
    |--------------------------------------------------------------------------
    */
    // POST /api/auth/logout : Permet de se déconnecter
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | User controller
    |--------------------------------------------------------------------------
    */
    // GET /api/user : Permet de récupérer les données de l'utilisateur
    Route::get('user', [UserController::class, 'getUser']);
    // DELETE /api/user : Permet de supprimer son compte
    Route::delete('user', [UserController::class, 'deleteUser']);

    /*
    |--------------------------------------------------------------------------
    | Categories controller
    |--------------------------------------------------------------------------
    */
    // POST /api/category : Permet de créer un catégorie
    Route::post('/category', [CategoriesController::class, 'createCategory']);
    // GET /api/category : Permet de récupérer les catégories
    Route::get('/category', [CategoriesController::class, 'getCategories']);
    // GET /api/category/{$idCategory}
    Route::get('/category/{idCategory}', [CategoriesController::class, 'getPostsbyCategory']);
});
