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

class UserController extends Controller
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
    public function me()
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
        $fields = $request->only(['first_name', 'last_name', 'expertise', 'avatar']);

        $user = Auth::guard()->user();
        $user->fill($fields);
        $user->save();

        return response()->json($user);
    }

    /**
     * Find Users by Skill
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function findBySkill($skillId)
    {
        $users = Skill::find($skillId)->users;

        return response()->json($users);
    }

    /**
     * Add Skill to User
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
     * Remove Skill from User
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
