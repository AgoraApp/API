<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
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
        return $this->belongsTo('App\Models\Place');
    }

    /**
     * Get the sessions for the zone.
     */
    public function sessions()
    {
        return $this->hasMany('App\Models\Session');
    }
}
