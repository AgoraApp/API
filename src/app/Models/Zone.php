<?php

namespace App\Models;

class Zone
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * Get the place for the zone.
     */
    public function place()
    {
        return $this->belongsTo('App\Place');
    }

    /**
     * Get the sessions for the zone.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
}
