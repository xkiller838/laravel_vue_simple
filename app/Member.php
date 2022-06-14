<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';

    protected $fillable = [
        'role_id ',
        'name',
        'email',       
        'phonenum',
        'address',
        'password'
    ];
}
