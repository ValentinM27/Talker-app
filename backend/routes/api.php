<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import des controleurs
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SuscribeController;

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
    // GET /api/category/{idCategory}
    Route::get('/category/{idCategory}', [CategoriesController::class, 'getPostsbyCategory']);

    /*
    |--------------------------------------------------------------------------
    | Post controller
    |--------------------------------------------------------------------------
    */
    // POST /api/post : Permet de créer un post
    Route::post('/post', [PostController::class, 'createPost']);
    // DELETE /api/post/{post} : Permet de supprimer un post
    Route::delete('/post/{post}', [PostController::class, 'deletePost'])->middleware('can:delete,post');
    // GET /api/post/{post} : Permet de récupérer un post grâce son id
    Route::get('/post/{post}', [PostController::class, 'getById']);

    /*
    |--------------------------------------------------------------------------
    | Comment controller
    |--------------------------------------------------------------------------
    */
    // POST /api/comment : Permet de créer un commentaire
    Route::post('/comment/{post}', [CommentController::class, 'createComment']);
    // DELETE /api/comment : Permet de supprimer un commentaire
    Route::delete('/comment/{comment}', [CommentController::class, 'deleteComment'])->middleware('can:delete,comment');
    // GET /api/comment : Permet de récupérer les commentaires d'un grâce à son id
    Route::get('/comment/{post}', [CommentController::class, 'getByPostId']);

    /*
    |--------------------------------------------------------------------------
    | Suscribe controller
    |--------------------------------------------------------------------------
    */
    // POST /api/suscribe/idCategory : Permet de s'abonner à une catégorie
    Route::post('/suscribe/{category}', [SuscribeController::class, 'suscribe']);
    // DELETE /api/suscribe : Permet de se désabonner d'une catégorie
    Route::delete('/suscribe/{category}', [SuscribeController::class, 'unSuscribe']);
    // GET /api/suscribes : Permet de récupérer les abonnement d'un utilisateur
    Route::get('/suscribes', [SuscribeController::class, 'suscribeTo']);
});
