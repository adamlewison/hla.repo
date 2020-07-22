<html>
<head>
    <?php

    include(app_path() . '/oldwebsite/includes.php');
    ?>

    <style>

    </style>
    <title>{{$project->title}} </title>
</head>
<body>

<?php
include(app_path() . '/oldwebsite/#header.php');
?>

<div id="mainbar" class="container">

    <div>
        <br />
        <h1>
            {{$project->title}}
        </h1>
    </div>

    <div id="gallery" style="display: none">

        @foreach($project->project_images as $image)
            <a href="http://www.hla.co.za">
                <img alt="{{$project->category}}" src="{{get_image_url($image->name)}}" data-image="{{get_image_url($image->name)}}" data-description="{{$image->name}}" >
            </a>
        @endforeach

    </div>

</div>

</body>

<script>
    jQuery(document).ready(function(){
        jQuery("#gallery").unitegallery({
            gallery_theme:"tiles",
            tiles_type:"nested",
            tiles_space_between_cols: 25
            //gallery_width:"100%",

        });

        $(".type-link").click(function(){
            var a = $(this).text();
            console.log(a);
            $("#gallery").find("img").parent().css('opacity', 0.2);
            $("#gallery").find("img[alt='" + a + "']").parent().css('opacity', 1);

        })
    });
</script>
</html>
