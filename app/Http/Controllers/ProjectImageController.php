<?php

namespace App\Http\Controllers;

use App\project;
use App\project_image;
use Illuminate\Http\Request;

class ProjectImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setAsThumb (project_image $image){
        $image->project->thumb = $image->name;
        $image->project->save();
        flash('Successfully set thumbnail!');
        return back();
    }

    public function delete(project_image $image) {
        $image->delete();
        flash('Successfully deleted image!');
        return back();
    }
}
