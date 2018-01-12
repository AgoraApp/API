<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Get Skills
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $skills = Skill::all();

        return response()->json($skills);
    }

    /**
     * Find Skills
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function find($value)
    {
        $skills = SKill::where('name','LIKE','%'.$value.'%')->take(10)->get();

        return response()->json($skills);
    }
}
