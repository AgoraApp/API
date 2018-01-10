<?php

namespace App\Models;

class Skill
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
     * Get the users for the skill.
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
