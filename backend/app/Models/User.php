<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * @property int $id
 * @property string $id_user
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Comment[] $comments
 * @property Collection|Post[] $posts
 * @property Collection|Suscribe[] $suscribes
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'users';

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'id_user',
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function comments()
	{
		return $this->hasMany(Comment::class, 'id_user', 'id_user');
	}

	public function posts()
	{
		return $this->hasMany(Post::class, 'id_user', 'id_user');
	}

	public function suscribes()
	{
		return $this->hasMany(Suscribe::class, 'id_user', 'id_user');
	}
}
