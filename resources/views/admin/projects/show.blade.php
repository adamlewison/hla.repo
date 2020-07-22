@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{$project->title}}
        </h1>

            @if (Session::has('flash_message'))
                <div class="alert alert-{{Session::get('flash_message_level')}}">{{Session::get('flash_message')}}</div>
            @endif

        <form action="/projects/{{$project->id}}/update" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="title" value="{{$project->title}}" placeholder="title" class="form-control">
            </div>

            <div class="form-group">
                <select name="category" class="form-control">
                    @foreach(App\Category::all()->sortBy('name') as $category)
                        <option value="{{$category->name}}" {{$project->category == $category->name ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="info" value="{{$project->info}}" placeholder="info" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="type" value="{{$project->type}}" placeholder="type" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="size" value="{{$project->size}}" placeholder="size" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="client" value="{{$project->client}}" placeholder="client" class="form-control">
            </div>

            <div class="form-group form-check">
                <input name="live" type="checkbox" class="form-check-input" {{ $project->live == 'on' ? "checked='checked'" : '' }}>
                <label class="form-check-label"  >live on website</label>
            </div>

            <input type="submit" class="btn btn-block btn-dark" value="edit">
        </form>

        <hr />
        <div class="row">
            <h2 class="d-flex">
                Project images
            </h2>

            <div class="pull-right">
                <a href="{{url()->current()}}/addImage">
                    <button type="button" class="btn btn-link">+ image</button>
                </a>
            </div>
        </div>

        <div class="card-columns">
            @foreach($project->project_images as $img)
                <div class="col mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="http://www.hla.co.za/images/project_images/{{$img->name}}" class="card-img-top" alt="...">
                        <div class="card-body {{ $project->thumb ==  $img->name ? 'bg-dark' : ''  }}">
                            <p class="card-text ">
                                <a href="/project_images/{{$img->id}}/setthumb">
                                    Set thumb
                                </a>
                                 |
                                <a href="/project_images/{{$img->id}}/delete">
                                  Delete
                                </a>
                            </p>
                        </div>
                    </div>
                </div>


            @endforeach

        </div>
    </div>
@endsection
