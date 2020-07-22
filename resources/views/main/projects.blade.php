<html>
<head>
    <?php
    include(app_path() . '/oldwebsite/includes.php');
    ?>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <style>
        .project_thumb {
            width: 100%;
            height: 225px;
            background-position: center center;
            background-size: cover;

        }

        .card.shadow-sm:hover {
            box-shadow: 0 .125rem .25rem rgba(57, 188, 82, 0.46)!important;
            cursor: pointer;
            transition: 0.5s ease;
            -webkit-transition: 0.5s ease;
        }

        .card-text {
            color: black !important;

        }
    </style>
    <title>HLArchitects projects</title>
</head>
<body>

<?php
include(app_path() . '/oldwebsite/#header.php');
?>


<div id="mainbar" class="">

    <!--
    <div id="project-types">
        <span class="type-link">commercial</span>   <span class="type-link">residential</span>   <span class="type-link">education</span>
    </div>
    -->
    <!--
    <div class="container d-flex justify-content-center" style="padding: 15px 0 0">

        <form class="form-inline md-form form-sm mt-0">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control ml-3 w-75" type="text" placeholder="Search" aria-label="Search" id="search-bar">
        </form>


    </div>
    -->
    <div id="project-types">
        @foreach(App\Category::all() as $category)
            <span class="type-link">{{$category->name}}</span>
        @endforeach
    </div>
    <div class="album py-5 bg-light">

        <div class="container">

            <div class="row" id="project-container">

                <?php

                $r = $db->getResult("SELECT project_id, max(score) AS 'score', name,title,type,client,category,thumb,live FROM `project_images`, `projects` WHERE projects.id = project_id AND live = 'on' GROUP BY project_id ORDER BY score DESC, project_id DESC");
                //$r = $db->getResult("SELECT * FROM `project_images`, `projects` WHERE projects.id = project_id ORDER BY project_id DESC, score DESC");

                $current_id = -1;
                foreach ($r as $project) {

                if ($current_id != $project['project_id']) {
                    $current_id = $project['project_id'];
                ?>

                <div class="col-md-4" data-search="<?= $project['title'] . ' ' .  $project['type'] . ' ' . $project['client'] ?>" data-type="<?= $project['category'] ?>">
                    <div class="card mb-4 shadow-sm">
                        <a href="projects/<?= $project['project_id'] ?>" style="text-decoration : none">
                            <!--
                           <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
                            <?php
                            if (isset($project['thumb'])) {
                                $img = $project['thumb'];
                            } else {
                                $img = $project['name'];
                            }
                            ?>
                            <div class="project_thumb" style="background-image: url('<?= get_image_url($img) ?>')"></div>


                            <div class="card-body">
                                <p class="card-text"><?= $project['title'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <!--<button type="button" class="btn btn-sm btn-outline-secondary">View</button>-->
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>

                <?php
                }
                }
                ?>


            </div>

        </div>

    </div>


</div>

</body>
<div class="d-none" id="projects-json">
    <?= json_encode($r) ?>
</div>
<script type="text/javascript">

    jQuery(document).ready(function(){

        $(".type-link").click(function(){
            var a = $(this).text();
            console.log(a);
            $('div[data-type]').hide();
            $('div[data-type="' + a + '"]').show("slow");

        })

    });

    function display_projects(projects, container) {
        projects.forEach(function() {

        })
        container.html("")
    }

</script>
</html>
