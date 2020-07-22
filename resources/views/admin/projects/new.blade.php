@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Create new project
        </h1>

        @if (Session::has('flash_message'))
            <div class="alert alert-{{Session::get('flash_message_level')}}">{{Session::get('flash_message')}}</div>
        @endif

        <form action="/projects/new" method="post">
            @csrf
            <div class="form-group">
                <input type="text" name="title" value="{{old('title')}}" placeholder="title" class="form-control">
            </div>

            <div class="form-group">
                <select name="category" class="form-control">
                    @foreach(App\Category::all()->sortBy('name') as $category)
                        <option value="{{$category->name}}" {{old('category') == $category->name ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="text" name="info" value="{{old('info')}}" placeholder="info" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="type" value="{{old('type')}}" placeholder="type" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="size" value="{{old('size')}}" placeholder="size" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="client" value="{{old('client')}}" placeholder="client" class="form-control">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="live">
                <label class="form-check-label" >live on website</label>
            </div>

            <input type="submit" class="btn btn-block btn-outline-success" value="create new">
        </form>

        <hr />

        @if ($errors->all())
            <div class="alert alert-dark mt-5">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            <hr />
        @endif

        <p class="lead">
            Add project images after creating the project by editing it.
        </p>
    </div>
@endsection
