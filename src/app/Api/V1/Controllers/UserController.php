<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Skill;

class UserController extends Controller
{
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
}
