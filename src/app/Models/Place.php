<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'zip_code', 'city', 'country', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'pivot', 'description',
    ];

    /**
     * Get the sessions for the place.
     */
    public function sessions()
    {
        return $this->hasMany('App\Models\Session');
    }

    /**
     * Get the zones for the place.
     */
    public function zones()
    {
        return $this->hasMany('App\Models\Zone');
    }

    /**
     * Get users who favourited the place
     */
    public function favouritedUsers()
    {
        return $this->belongsToMany('App\Models\User', 'user_place_favourites');
    }

    public static function getByDistance($lat, $lng, $distance)
    {
        $results = DB::select(DB::raw('
            SELECT id, name, address, image, latitude, longitude, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance
            FROM places
            HAVING distance < ' . $distance . '
            ORDER BY distance'
        ));

        return $results;
    }
}
