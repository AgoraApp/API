<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Get the skills for the guest.
     */
    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'guest_skill');
    }

    /**
     * Get the sessions for the guest.
     */
    public function sessions()
    {
        return $this->hasMany('App\Models\Session');
    }
}
