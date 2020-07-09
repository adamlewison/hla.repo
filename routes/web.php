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
    $adminurl = '';
    return $adminurl . $url;
}

function main_site($url) {
    $mainsiteurl = '';
    return $mainsiteurl . $url;
}

Route::get(admin_page('/'), function () {
    return view('welcome');
});

Route::get(admin_page('/home'), 'HomeController@index')->name('home');
Route::get(admin_page('/projects'), 'HomeController@index')->name('home');

Route::get(admin_page('/projects/{project}'), 'ProjectController@show');
Route::get('/projects/{project}/delete', 'ProjectController@delete');

Route::get(admin_page('projects/{project}/addImage'), 'ProjectController@newImage');
Route::post(admin_page('projects/{project}/addImage'), 'ProjectController@addImages');



Route::post(admin_page('/projects/{project}/update'), 'ProjectController@update');

Route::get(admin_page('project_images/{image}/setthumb'), 'ProjectImageController@setAsThumb');
Route::get(admin_page('project_images/{image}/delete'), 'ProjectImageController@delete');



