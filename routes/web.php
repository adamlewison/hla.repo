<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

function admin_page($url) {
    $adminurl = 'admin';
    return $adminurl . $url;
}

function main_site($url) {
    $mainsiteurl = '';
    return $mainsiteurl . $url;
}


Route::get(admin_page('/'), function () {
    return view('admin.welcome');
});

Route::get(main_site('/home'), 'HomeController@index')->name('home');

Route::get(admin_page('/home'), 'HomeController@index');
Route::view(admin_page('/projects'), 'admin.projects');
Route::view(admin_page('/categories'), 'admin.categories.index');

Route::get(admin_page('/projects/create'), 'AdminController@newProject');
Route::get(admin_page('/projects/{project}'), 'AdminController@show');
Route::get(admin_page('/projects/{project}/addImage'), 'AdminController@newImage');

// Actions to be done to a project
Route::get('/projects/{project}/delete', 'ProjectController@delete');
Route::post('/projects/{project}/update', 'ProjectController@update');
Route::post('/projects/new', 'ProjectController@new');
Route::post('/projects/{project}/addImage', 'ProjectController@addImages');

// Actions to be done to a project_image
Route::get('/project_images/{image}/setthumb', 'ProjectImageController@setAsThumb');
Route::get('/project_images/{image}/delete', 'ProjectImageController@delete');

// Actions to be done to a category
Route::post('/categories/create', 'CategoryController@create');
Route::get('/categories/{category}/delete', 'CategoryController@delete');
Route::post('/categories/{category}/edit', 'CategoryController@edit');

// Random Image API
Route::get('/random', function () {
     $img = App\project_image::getRandomImage();
    return $img;
});

Route::get('/random/{project}', function ($project) {
    $img = App\project_image::getRandomImage($project);
    return $img;
});

// Consumer Website routes
Route::get('/', "HomeController@homePage");
Route::get('/projects', "HomeController@projectsPage");
Route::get('/projects/{project}', "HomeController@projectPage");
Route::get('/about', "HomeController@aboutPage");
Route::get('/contact', "HomeController@contactPage");




