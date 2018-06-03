<?php   
    require __DIR__ . "/../data.php";

    
function get_template(){
        
    $content = get_all_sections_for_page();
    ?>
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