<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'end_at', 'description', 'place_id', 'zone_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at', 'guest_id', 'user_id'
    ];

    /**
     * Get the user for the session.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the guest for the session.
     */
    public function guest()
    {
        return $this->belongsTo('App\Models\Guest');
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
