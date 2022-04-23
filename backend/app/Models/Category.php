<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property string $id
 * @property string $label
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Post[] $posts
 * @property Collection|Suscribe[] $suscribes
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categories';
	public $incrementing = false;

	protected $fillable = [
		'label'
	];

	public function posts()
	{
		return $this->hasMany(Post::class, 'id_category');
	}

	public function suscribes()
	{
		return $this->hasMany(Suscribe::class, 'id_category');
	}
}
