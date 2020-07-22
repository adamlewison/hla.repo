<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('admin.categories.index');
    }

    public function delete(Category $category) {
        $name = $category->name;
        $category->delete();

        flash( $name .' has been deleted', 'info');
        return back();
    }

    public function create() {

        request()->validate([
            'name' => 'required'
        ]);

        $category = Category::create(request()->all());
        flash( $category->name . ' has been created', 'success');
        return back();
    }

    public function edit(Category $category) {

        request()->validate([
            'name' => 'required'
        ]);

        $category->update(request()->all());
        $name = $category->name;
        flash( 'Update saved!', 'success');
        return back();
    }
}
