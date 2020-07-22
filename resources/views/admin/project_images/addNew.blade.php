@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>
            Add image to {{$project->title}}
        </h3>

        <form action="/projects/{{$project->id}}/addImage" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Select multiple images by holding shift</label>
                <input type="file" name="images[]" placeholder="title" class="form-control-file" multiple>
            </div>

            <input type="submit" class="btn btn-block btn-dark" value="submit">
        </form>

        @if ($errors->all())
        <div class="alert alert-dark mt-5">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
            </ul>
        </div>
            @endif


    </div>
@endsection
