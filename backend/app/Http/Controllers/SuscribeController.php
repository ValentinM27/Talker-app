<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Suscribe;
use App\Models\Category;
use App\Http\Controllers\UserController;


class SuscribeController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserController;
    }

    public function suscribe(Category $category)
    {
        $suscribe = new Suscribe();
        $suscribe->id_category = $category->id;
        $suscribe->id_user = $this->user->getUserUUID();
        $suscribe->save();

        return $suscribe;
    }

    public function unSuscribe(Category $category)
    {
        return Suscribe::where('id_category', $category->id)
                    ->where('id_user', $this->user->getUserUUID())
                    ->delete();
    }

    public function suscribeTo()
    {
        return Suscribe::where('id_user', $this->user->getUserUUID())->pluck('id_category');
    }
}
