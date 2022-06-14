<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag_photo extends Model
{
    protected $table = 'tag_photo';

    protected $fillable = [
        'tag_id',
        'photo_id'
    ];
}
