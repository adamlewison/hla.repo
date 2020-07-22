<?php

namespace App\Http\Controllers;

use App\project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'homePage',
            'projectsPage',
            'aboutPage',
            'contactPage',
            'projectPage'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }

    public function homePage() {
        return view('main.index');
    }

    public function projectsPage() {
        return view('main.projects');
    }

    public function contactPage() {
        return view('main.contact');
    }

    public function aboutPage() {
        return view('main.about');
    }

    public function projectPage(project $project) {
        $project->load('project_images');
        //dd($project);
        return view('main.project', ['project' => $project]);
    }
}
