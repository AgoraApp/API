<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Place;

class PlaceController extends Controller
{
    /**
     * Get Places
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $places = Place::all();

        return response()->json($places);
    }

    /**
     * Get Places by location
     * 
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function nearBy(Request $request)
    {
        if (!$request->has('latitude') || !$request->has('latitude')) {
            return response()->json(['error' => 'Latitude or Longitude not provided'], 400);
        }

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $places = Place::getByDistance($latitude, $longitude, 20);

        return response()->json($places);
    }
}
