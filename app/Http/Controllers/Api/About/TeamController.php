<?php

namespace App\Http\Controllers\Api\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;

class TeamController extends Controller
{
    //
    public function TeamMember(){
        $teams = TeamMember::first();
        return response()->json($teams);
    }
}
