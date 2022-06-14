<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    protected $fillable = [
        'title'
    ];

    public function photos()
    {
        return $this->belongsToMany('App\Photo', 'tag_photo', 'tag_id', 'photo_id');
        
    }
}
