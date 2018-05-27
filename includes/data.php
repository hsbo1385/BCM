<?php
    require __DIR__ . "/items/section.php";
    require __DIR__ . "/items/content_types.php";

    function get_all_sections_for_page(){

        global $conn;
        //get all sections
        $sql = "SELECT * 
                FROM section 
                ORDER BY order_on_page ASC";
        $result = $conn->query($sql);

        //return error message if no sections found
        if(!$result->num_rows > 0)
            throw new Exception("No data found");
            

        //create array of section objects
        $sections = array();
        foreach ($result as $section)
            array_push($sections, new Section($section));
        
        return $sections;
    }

    function get_content_types(){
        //create array of section objects
        return new ContentTypes();
    }
?>