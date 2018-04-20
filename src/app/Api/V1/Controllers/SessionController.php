<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Session;

class SessionController extends Controller
{
    /**
     * Get sessions by place
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findByPlace($placeId)
    {
        $sessions = Session::with(['user', 'guest', 'zone'])->where('place_id', $placeId)->get();

        return response()->json($sessions);
    }

    /**
     * Get sessions by user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findByUser(Request $request)
    {
        if ($request->has('user_id')) {
            $userId = $request->input('user_id');
            $sessions = Session::where('user_id', $userId)->get();
            
            return response()->json($sessions);
        } else if ($request->has('guest_id')) {
            $guestId = $request->input('guest_id');
            $sessions = Session::where('guest_id', $guestId)->get();
            
            return response()->json($sessions);
        } else {
            return response()->json([
                "error" => [
                    "message" => "NO_USER_OR_GUEST_PROVIDED",
                    "status_code" => 400,
                ]
            ], 400);
        }
    }
}
