<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';

    protected $fillable = [
        'album_id',
        'location_id',
        'member_id',
        'title',
        'description',
        'privacy',
        'uploaddate',
        'view',
        'imagepath'
    ];

    
    
    public function albums()
    {
        return $this->belongsTo('App\Album','album_id');
    }

    public function locations()
    {
        return $this->belongsTo('App\Location','location_id');
    }

    public function members()
    {
        return $this->belongsTo('App\Member','member_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tag_photo', 'tag_id', 'photo_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    function getImagepathAttribute($imagepath){
        return route('archivo',['ruta' => $imagepath]);
    }

    protected $casts = [
        'uploaddate' => 'datetime',
    ];
}
