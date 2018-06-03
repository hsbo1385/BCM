<?php   
    
function create_html(){
    //get html markup
    $html = get_template();
    //define file
    $file = __DIR__ . '/../../index.html';
    //delte file if exists
    unlink($file);
    //create handler, open file
    $handler = fopen($file, "w") or die('Cannot create or open HTML file');
    //input html to file
    file_put_contents($file, $html);
    //close file
    fclose($handler);
    die();
}
    
function get_template(){
        
    ob_start();
    require_once __DIR__ . "/../data.php";

    $content = get_all_sections_for_page();
    ?>
    <?php 
        foreach ($content as $section)
            require_once __DIR__ . "/sections/section-".$section->get_template_name().".php";
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
    return strval(ob_get_clean());
    }
?>