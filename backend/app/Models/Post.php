<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * 
 * @property string $id
 * @property string $content
 * @property string $id_category
 * @property string $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property User $user
 * @property Collection|Comment[] $comments
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'posts';
	public $incrementing = false;

	protected $fillable = [
		'content',
		'id_category',
		'id_user'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'id_category');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user', 'id_user');
	}

	public function comments()
	{
		return $this->hasMany(Comment::class, 'id_post');
	}
}
