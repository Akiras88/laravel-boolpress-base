<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Mass Assign
    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];
    /**
     * DB relantionship
     */
    // User (many to one)
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // Comment (one to many)
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
