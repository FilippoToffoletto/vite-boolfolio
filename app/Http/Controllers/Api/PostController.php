<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $projects = Project::with(['category'])->orderBy('id', 'desc')->paginate(10);

        return response()->json(compact('projects'));
    }
}
