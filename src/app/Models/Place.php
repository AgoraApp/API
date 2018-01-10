<?php

namespace App\Models;

class Place
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'zip_code', 'city', 'country'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the sessions for the place.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    /**
     * Get the zones for the place.
     */
    public function zones()
    {
        return $this->hasMany('App\Zone');
    }
}
