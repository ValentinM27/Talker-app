<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Suscribe
 * 
 * @property string $id_category
 * @property string $id_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property User $user
 *
 * @package App\Models
 */
class Suscribe extends Model
{
	protected $table = 'suscribes';
	public $incrementing = false;

	public function category()
	{
		return $this->belongsTo(Category::class, 'id_category');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}
