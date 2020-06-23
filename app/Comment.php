<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Mass Assign
    protected $fillable = [
        'post_id',
        'title',
        'body'
    ];
    /**
     * DB relantionship
     */
    //  Post (many to one)
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
