<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
    protected $fillable = ['body','user_id','post_id'];
    protected $appends = ['customPost'];
    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

    public function post()
    {
    	return $this->belongsTo(Post::class, 'post_id');
    }
    public function getCustomPostAttribute()
    {
    	$url =  route('posts.show',['id'=>$this->post->id]);
    	return <<<HTML
    	<a href="$url">Show</a>
HTML;
    }
}
