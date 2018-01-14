<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Get the users for the skill.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_notification');
    }
}
