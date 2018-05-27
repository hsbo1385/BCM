<?php   
    require __DIR__ . "/../data.php";

    
    function get_template(){
        
    $content = get_all_sections_for_page();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- styles -->
    <!-- plugins -->
    <link rel="stylesheet" href="assets/css/plugins/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <link rel="stylesheet" href="assets/other_plugins/slick/slick.css">
    <link rel="stylesheet" href="assets/other_plugins/slick/slick-theme.css">
    <!-- original css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- javascripts -->
    <!-- plugins -->
    <script src="assets/js/plugins/jquery-3.2.1.min.js"></script>
    
    <title>BCM Demo</title>
</head>
<body>
    <?php 
        foreach ($content as $section) 
            require __DIR__ . "/sections/section-".$section->get_template_name().".php";
    ?>
    <!-- javascript -->
    <!-- plugins -->
    <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/other_plugins/slick/slick.min.js"></script>    
    <script src="assets/js/plugins/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- original js -->
    <script src="assets/js/js.js"></script>
</body>
</html>

<?php   
    }
?>