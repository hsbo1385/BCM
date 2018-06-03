<?php 

require  __DIR__ . "/../web-config.php";
require  __DIR__ . "/field.php";

class Section
{
    private $id;
    private $display_name;
    private $order_on_page;
    private $template;
    private $in_menu;
    private $fields = array();

    public function __construct($section_item){
        //get db connection
        global $conn;

        $sql = "SELECT order_on_page 
                FROM `section`
                ORDER BY order_on_page
                DESC
                LIMIT 1";
        $result = $conn->query($sql);
        $order;
        foreach ($result as $o)
            $order = $o["order_on_page"] + 1;

        //set parameters to input row
        $this->id = isset($section_item['id']) ? intval($section_item['id']) : null;
        $this->display_name = $section_item['display_name'];
        $this->order_on_page = isset($section_item['order_on_page']) ? intval($section_item['order_on_page']) : $order;
        $this->template = $section_item["template"];
        $this->in_menu = boolval($section_item["in_menu"]);
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

    function get_display_name(){
        return $this->display_name;
    }

    function get_template_name(){
        return $this->template;
    }
    function is_in_menu(){
        return (intval($this->in_menu) === 1);
    }
    public static function find_section($id){
        global $conn;
        $id = intval($id);
        $sql = "SELECT * 
            FROM section 
            WHERE id = " . $id;
        $result = $conn->query($sql);
        if(!$result)
            return null;
        
        $section = new Section($result->fetch_assoc());

        return $section;
    }
    public static function delete_section($id){
        global $conn;
        $sql = "DELETE FROM `section` WHERE `section`.`id` = ". $id .";";
        $result = $conn->query($sql);

        foreach ($this->fields as $field)
            Field::delete_field($field->get_id());
    }
    /* setters */
    public function update_section($template, $order, $menu){
        $this->template = $template;
        $this->order_on_page = intval($order);
        $this->in_menu = $menu;
    }
    public function save(){
        global $conn;
        if($this->id == null):
            $sql = "INSERT INTO `section` 
            (`id`, 
            `order_on_page`, 
            `display_name`, 
            `template`,
            `in_menu`
            ) 
            VALUES (NULL, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            
            $stmt->bind_param(
                "issi",
                $this->order_on_page,
                $this->display_name,
                $this->template,
                intval($this->in_menu)
            );

            $result = $stmt->execute();
            if(!$result)
                var_dump($conn);
            $this->id = $result["id"];
        else:
            $sql = "UPDATE `section` 
            SET 
            `template` = ?,
            `order_on_page` = ?,
            `in_menu` = ?
            WHERE `section`.`id` = ".$this->id.";";

            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param(
                "ssi",
                $this->template,
                $this->order_on_page,
                $this->in_menu
            );
            $result = $stmt->execute();
            if(!$result)
                echo $result->error;
        endif;
    }
}

?>