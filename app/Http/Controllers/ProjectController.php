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
        return view('admin.projects.show', compact('project'));
    }

    public function delete(project $project) {
        $title = $project->title;
        $project->delete();
        flash( $title .' has been deleted', 'info');
        return back();
    }

    public function newImage(Request $request, project $project) {
        return view('admin.project_images.addNew', ['project' => $project]);
    }

    public function addImages(project $project) {


        request()->validate([
            'images' => 'required|max:2048'
        ]);

        //dd(request()->images);

        foreach (request()->images as $file) {
            $project->addImage($file);
        }

        return redirect('/admin/projects/'.$project->id);
    }

    public function new() {

        request()->validate([
            'category'  => 'required',
            'title'     => 'required'
        ]);

        $args = (array) request()->all();
        if (!isset($args['live'])) {
            $args['live'] ='off';
        }

        $project = project::create($args);

        flash("This is your fresh new project!");
        return redirect('/admin/projects/'.$project->id);
    }

    public function update(project $project) {

        request()->validate([
            'category'  => 'required',
            'title'     => 'required'
        ]);

        $args = (array) request()->all();
        if (!isset($args['live'])) {
            $args['live'] ='off';
        }

        $project->update( $args );
        flash('Success!');
        return back();
    }
}
