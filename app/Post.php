<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';
  protected $fillable = [
		'id',
		'title',
		'body',
		'image',
	];
	protected $appends = ['CustomeBody'];
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }
	public function getCustomeBodyAttribute()
	{
		return <<<SCRIPT
 
<a href="#" data-toggle="modal" data-target="#myModal" >Show</a>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Description</h4>
        </div>
        <div class="modal-body">
          <p style="word-wrap: break-word;"> $this->body </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  
</div>

SCRIPT;
	}
}
