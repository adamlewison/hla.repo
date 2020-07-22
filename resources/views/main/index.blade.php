<html>
<head>
    <?php
    include(app_path() . '/oldwebsite/includes.php');
    ?>


    <link rel='stylesheet' type='text/css' href='style.php?v=<?= time() ?>' />
    <style>

    </style>
    <title>HLArchitects</title>
</head>
<body>

<?php
include(app_path() . '/oldwebsite/#header.php');
?>

<div id="sidebar">

</div>
<div id="mainbar" class="container">
    <!--
    <div id="project-types"> <span class="type-link">commercial</span>   <span class="type-link">residential</span>   <span class="type-link">education</span> </div>
    -->
    <div id="gallery" style="display:none;">

        <?php


        $r = $db->getResult("SELECT * FROM `project_images` LEFT JOIN projects ON projects.id = project_id");

        // (Sigma)p(x) = P(x)

        $sumofp = 0;

        $list = array();

        function f($x) {
            $C = 1.00;
            return $C * pow($x, 5);
        }

        foreach ($r as $row) {
            $sumofp += f($row['score']);
        }

        for ($i = 0; $i < 50; $i++) {

        $B = rand(0,$sumofp);

        $s = 0;
        $a = -1;

        foreach ($r as $k => $row) {
            $s += f($row['score']);

            if ($s >= $B) {
                $a = $k;
                break;
            }
        }

        $obj = $r[$a];
        $src = get_image_url($obj['name']);

        ?>
        <a href="projects/<?= $obj['id'] ?>">
            <img alt="<?= $obj['category'] ?>" src="<?= $src ?>" data-image="<?= $src ?>" data-description="<?= $obj['name']; ?>. Image score: <?= $obj['score']?>" >
            Score~: <?= $obj['score'] ?>
        </a>
        <?php

        $sumofp -= f($obj['score']);
        unset($r[$a]);

        }

        ?>



    </div>

</div>

</body>

<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery("#gallery").unitegallery({
            gallery_theme:"tiles",
            tile_as_link:true,
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
