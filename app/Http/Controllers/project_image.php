<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class project_image extends Controller
{
    protected $fillable = [
        'name'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setAsThumb (project_image $image){
        $image->project->thumb = $image->name;
        $image->project->save();
        return back();
    }
}
