<html>
<head>
    <?php
    include(app_path() . '/oldwebsite/includes.php');
    ?>

    <title>HLArchitects contact</title>
</head>
<body>

<?php
include(app_path() . '/oldwebsite/#header.php');
?>

<div id="sidebar">

</div>



<div id="mainbar" class="container">


    <div class="jumbotron jumbotron-fluid" data-display="practice">
        <div class="container">
            <h1 class="display-4">Contact HLArchitects</h1>
            <p class="lead">Email <a href="mailto:hla@hla.co.za">hla@hla.co.za</a></p>
        </div>
    </div>



</div>

</body>

<script type="text/javascript">

    jQuery(document).ready(function(){

        var active_type;

        // data-display, data-recolor

        $(".type-link").click(function(){
            active_type = $(this).attr("data-recolor");


            $(".type-link").removeClass("active");
            $(".type-link[data-recolor='" + active_type + "']").addClass("active");

            $(".jumbotron").hide();
            $(".jumbotron[data-display='" + active_type + "']").slideToggle();
        })
    });


</script>
</html>
