<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'started_at', 'end_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Get the user for the session.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the place for the session.
     */
    public function place()
    {
        return $this->belongsTo('App\Models\Place');
    }

    /**
     * Get the zone for the session.
     */
    public function zone()
    {
        return $this->belongsTo('App\Models\Zone');
    }
}
