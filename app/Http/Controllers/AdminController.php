<?php

namespace App\Http\Controllers;

use App\project;
use App\project_image;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show (project $project) {
        $project->load('project_images');
        return view('admin.projects.show', compact('project'));
    }

    public function newImage(Request $request, project $project) {
        return view('admin.project_images.addNew', compact('project'));
    }

    public function newProject() {
        return view('admin.projects.new');
    }


}
