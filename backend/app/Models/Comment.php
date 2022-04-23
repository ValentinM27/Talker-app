<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * 
 * @property string $id
 * @property string $content
 * @property string $id_post
 * @property string $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Post $post
 * @property User $user
 *
 * @package App\Models
 */
class Comment extends Model
{
	protected $table = 'comments';
	public $incrementing = false;

	protected $fillable = [
		'content',
		'id_post',
		'id_user'
	];

	public function post()
	{
		return $this->belongsTo(Post::class, 'id_post');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user', 'id_user');
	}
}
