<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoComment extends Model
{
    // Mass assign
    protected $fillable = [
        'user_id',
        'phone', 
        'address', 
        'avatar'
    ];

    public $timestamps = false;
    /**
     * DB relantionship
     */
    // Comments (one to one)
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
