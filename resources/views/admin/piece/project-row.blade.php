<div class="row project-row p-2 border-bottom pb-3 " data-search-name="{{ $project->title }}" data-id="{{ $project->id }}"
     data-clickable-activate="#edit-project-btn:/admin/projects/{{ $project->id }}&&#delete-project-btn:/projects/{{ $project->id }}/delete">

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


<!--
<div class="pull-right mt-3 ">
    <a href="projects/{{$project->id}}" class="text-primary">
        edit
    </a>
     |
    <a href="/projects/{{$project->id}}/delete" class="text-danger">
        delete
    </a>
</div>
-->
</div>
