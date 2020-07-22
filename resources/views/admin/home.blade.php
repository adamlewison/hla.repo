@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                    <a class="nav-link" id="v-pills-profile-tab" href="/{{admin_page('/projects')}}" role="tab" aria-controls="v-pills-profile" aria-selected="false">Projects</a>
                    <a class="nav-link" id="v-pills-messages-tab" href="/{{admin_page('/notes')}}" role="tab" aria-controls="v-pills-messages" aria-selected="false">Notes</a>
                </div>
            </div>
            <div class="col-6">
                <img src="http://www.hla.co.za/images/project_images/{{\App\project_image::getRandomImage()->name}}" alt="" class="changing-picture">
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <style>
        .changing-picture {
            transition: opacity .5s ease-out;
            -moz-transition: opacity .5s ease-out;
            -webkit-transition: opacity .5s ease-out;
            -o-transition: opacity .5s ease-out;
        }

    </style>

    <!--suppress VueDuplicateTag -->
    <script>

        $(document).ready(function(){

            src = $('.changing-picture').attr('src');
            url = src.substring(0, src.lastIndexOf('/') + 1);

            setInterval(function () {
                $.getJSON('/random', function (data) {
                    $('.changing-picture').css('opacity', 0);
                    setTimeout(function(){
                        $('.changing-picture').attr('src', url + data.name);
                        $('.changing-picture').css('opacity', 1);
                    },250);

                });
            }, 3000)
        });

    </script>
@endsection
