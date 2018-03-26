<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use App\Models\Skill;
use Auth;

class MeController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', []);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Auth::guard()->user());
    }

    /**
     * Update the authenticated User
     *
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $fields = $request->only(['first_name', 'last_name', 'expertise']);
        
        $user = Auth::guard()->user();
        $user->fill($fields);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar')->store($user->id, 'avatars');
            $user->avatar = "storage/avatars/$avatar";
        }

        $user->save();

        return response()->json($user);
    }

    /**
     * Get sessions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSessions()
    {
        $user = Auth::guard()->user();
        $sessions = $user->sessions;

        return response()->json($sessions);
    }

    /**
     * Create session
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSession(Request $request)
    {
        $data = $request->all();
        $session = new Session($data);
        $session->save();

        $user = Auth::guard()->user();
        $user->sessions()->save($session);

        return response()->json($session);
    }

    /**
     * Add Skill
     * 
     * @param String $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function addSkill($name)
    {
        $user = Auth::guard()->user();

        $skill = Skill::firstOrCreate(['name' => $name]);
        $user->skills()->syncWithoutDetaching([$skill->id]);

        return response()->json(['status' => 'ok', 'user' => $user]);
    }

    /**
     * Remove Skill
     * 
     * @param Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeSkill($id)
    {
        $user = Auth::guard()->user();

        $user->skills()->detach($id);

        return response()->json(['status' => 'ok', 'user' => $user]);
    }
}