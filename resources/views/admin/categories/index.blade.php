@extends('layouts.app')

@section('content')

    <div class="container">
        @include('includes.flash')

        @foreach(\App\Category::all()->sortBy('name') as $category)
            <div class="row category-row p-2 border-bottom pb-3 " data-search-name="{{ $category->name }}" data-id="{{ $category->id }}"
            data-clickable-slide="this/.forForm">
                <div class="col-6">
                    <h4 class="ml-2 mt-2">
                        {{$category->name}}
                    </h4>
                </div>
                <div class="col-6 forForm" style="display: none">
                    <form action="/categories/{{$category->id}}/edit" method="post" class="form-inline">
                        @csrf
                        <div class="input-group mr-sm-2 mt-1 w-75">
                            <input type="text" class="form-control" value="{{$category->name}}" name="name">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">edit</button>
                            </div>
                        </div>
                        <div class="input-group mt-1">
                            <a href="/categories/{{$category->id}}/delete">
                                <button type="button" class="btn btn-danger">delete</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="p-2 mt-3">
            <button class="btn btn-outline-dark" onclick="$('.create-new-category').slideToggle()">
                Create a new category
            </button>
        </div>

        <div class="create-new-category p-2" style="display: none">
            <h2>Create a new category</h2>
            <form action="/categories/create" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            new Clickable('.category-row', {
                action: 'dblclick'
            });

        });


    </script>

    <style>

        a.disabled {
            pointer-events: none;
            cursor: default;
        }

        .category-row {
            transition: 0.5s;
        }
    </style>
@endsection
