@extends('layouts.app')

@section('content')

<div class="sticky mb-2">
    <div>
        <div class="row p-3">
            <div class="col-7">
                <input type="text" placeholder="Search Projects..." name="project_name" class="form-control project-search-bar">
            </div>
            <div class="col-5">
                <div style="float: right">
                    <a href="/admin/projects/create" id="new-project-btn">
                        <button class="btn btn-outline-success">
                            new project
                        </button>
                    </a>
                    <a href="/admin/projects/" class="disabled" id="edit-project-btn">
                        <button class="btn btn-outline-info disabled" disabled>
                            edit project
                        </button>
                    </a>
                    <a href="/projects/delete" class="disabled" id="delete-project-btn">
                        <button class="btn btn-outline-danger disabled" disabled>
                            delete project
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    @include('includes.flash')

    @foreach(\App\project::all() as $project)
        @include('admin.piece.project-row', compact('project'))
    @endforeach


</div>
@endsection

@section('scripts')
<script>
    var c;
    $(document).ready(function () {

        /**
         * Search bar
         */
        $('.project-search-bar').keyup(function () {
            $('.project-row').hide();
            console.log("here");
            search = $(this).val();
            $('.project-row').each(function (i, v) {
                if ($(v).attr('data-search-name').toLowerCase().includes(search.toLowerCase())) {
                    $(v).show();
                }
            });
        });


    })
    clickably('.project-row');
</script>

<style>
    div.sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background: white;
        z-index: 10000;
        box-shadow: 0 8px 6px -6px #ccc;
        margin-top: -25px;
    }
    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
@endsection
