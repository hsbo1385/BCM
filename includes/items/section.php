<?php 

require  __DIR__ . "/../web-config.php";
require  __DIR__ . "/field.php";

class Section
{
    private $id;
    private $name;
    private $display_name;
    private $order_on_page;
    private $page_id;
    private $template;

    private $fields = array();

    public function __construct($section_item){
        //set parameters to input row
        $this->id = intval($section_item['id']);
        $this->name = $section_item['name'];
        $this->display_name = $section_item['display_name'];
        $this->order_on_page = intval($section_item['order_on_page']);
        $this->page_id = intval($section_item['page_id']);
        $this->template = $section_item["template"];
        
        //get db connection
        global $conn;
        
        //query db
        $sql = "SELECT * 
                FROM field 
                WHERE section_id = " . $this->id . "
                ORDER BY order_in_section ASC";
        $result = $conn->query($sql);

        //if fields exist, populate fields param
        if($result->num_rows > 0)
            foreach ($result as $field) 
                array_push($this->fields, new Field($field));
    }
    /* getters */
    function get_id(){
        return $this->id;
    }
    function get_fields(){
        return $this->fields;
    }

    function get_order(){
        return $this->order_on_page;
    }

    function get_name(){
        return $this->name;
    }

    function get_display_name(){
        return $this->display_name;
    }

    function get_template_name(){
        return $this->template;
    }
    /* setters */
}

?>