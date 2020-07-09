<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\project;
use App\project_image;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show (project $project) {
        $project->load('project_images');
        //return $project;
        return view('projects.show', compact('project'));
    }

    public function update(project $project) {
        //return request()->all();
        $project->update( request()->all() );
        flash('Success!');
        return back();
    }

    public function delete(project $project) {
        $project->delete();
        return back();
    }

    public function newImage(Request $request, project $project) {
        return view('project_images.addNew', ['project' => $project]);
    }

    public function addImages(project $project) {


        request()->validate([
            'images' => 'required|max:2048'
        ]);

        //dd(request()->images);

        foreach (request()->images as $file) {
            $project->addImage($file);
        }

        return redirect('/projects/'.$project->id);
    }
}
