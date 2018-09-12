<?php

namespace Api\Comments\Models;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [];

     /**
     *
     * @var string
     */
     protected $table = '';
     /**
     *
     * @var array
     */
     protected $appends = [];
}
