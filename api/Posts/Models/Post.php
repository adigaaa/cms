<?php
namespace Api\Posts\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	protected $table = 'posts';
	protected $fillable = [
		'id',
		'title',
		'body',
		'image',
		'user_id',
	];

}