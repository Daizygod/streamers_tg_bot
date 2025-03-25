<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\IdeaStatusEnum;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Idea
 * 
 * @property int $id
 * @property string $message
 * @property string $sender_tg
 * @property int $created_at
 * @property string $status
 *
 * @package App\Models
 */
class Idea extends Model
{
	protected $table = 'ideas';
	public $timestamps = false;

    protected $cast = [
        'status' => IdeaStatusEnum::class
    ];

	protected $fillable = [
		'message',
		'sender_tg',
		'status',
        'created_at'
	];
}
