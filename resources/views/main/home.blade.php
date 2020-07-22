@extends('layouts.app')

@section('content')
<div class="container">



                    <!--
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    -->

                    <div class="row justify-content-md-center p-3">
                        <div class="col-md-6">
                            <input type="text" placeholder="Search Projects..." name="project_name" class="form-control project-search-bar">
                        </div>

                    </div>

                    @foreach(\App\project::all() as $project)

                            <div class="row project-row p-2 border-bottom pb-3 " data-search-name="{{ $project->title }}">

                                <div class="d-flex col">
                                    @if($project->thumb)
                                        <img src="http://www.hla.co.za/images/project_images/{{$project->thumb}}" alt="" class="rounded" height="50px">
                                    @else
                                        <img src="https://placeimg.com/640/480/arch" alt="" class="rounded-0" height="50px">
                                    @endif
                                    <h4 class="ml-2 mt-2">
                                        {{$project->title}}
                                    </h4>
                                </div>


                                <div class="pull-right mt-3 ">
                                    <a href="projects/{{$project->id}}" class="text-primary">
                                        edit
                                    </a>
                                     |
                                    <a href="projects/{{$project->id}}/delete" class="text-danger">
                                        delete
                                    </a>
                                </div>
                            </div>

                    @endforeach


</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.project-search-bar').keyup(function () {
            $('.project-row').hide();
            console.log("here");
            search = $(this).val();
            $('.project-row').each(function (i,v) {

                if ($(v).attr('data-search-name').toLowerCase().includes(search.toLowerCase())) {
                    $(v).show();
                }
            });
        })
    })
</script>
@endsection
