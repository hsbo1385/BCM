<?php
    require __DIR__ . "/../web-config.php";

    class Field{
        private $id;
        private $section_id;
        private $content;
        private $content_type;
        private $order_in_section;
        private $label;
        private $id_name;

        static $order_generator = 0;

        public function __construct($field_item){
            $this->id = isset($field_item['id']) ? intval($field_item['id']) : null;
            $this->section_id = intval($field_item['section_id']);
            $this->content = isset($field_item['content']) ? $field_item['content'] : null;
            $this->content_type = $field_item['content_type'];
            $this->order_in_section = isset($field_item['order_in_section']) ? intval($field_item['order_in_section']) : 1;
            $this->label = $field_item['label'];
            $this->id_name = isset($field_item["id_name"]) ? $field_item["id_name"] : strval(implode("_", explode(" ", strtolower($this->label))));
        }
        /* getters */
        public function get_id(){
            return $this->id;
        }
        public function get_content(){
            return $this->content;
        }
        public function get_content_type(){
            return $this->content_type;
        }
        public function get_order(){
            return $this->order_in_section;
        }
        public function get_label(){
            return $this->label;
        }
        public function get_id_name(){
            return $this->id_name;
        }

        public static function find_field($id){
            global $conn;
            $id = intval($id);
            $sql = "SELECT * 
                FROM field 
                WHERE id = " . $id;
            $result = $conn->query($sql);
            if(!$result)
                return null;
            
            $field = new Field($result->fetch_assoc());

            return $field;
        }
        public static function delete_field($id){
            global $conn;
            $sql = "DELETE FROM `field` WHERE `field`.`id` = ". $id .";";
            $result = $conn->query($sql);
        }
        /* setters */
        public function update_content_and_order($content, $order){
            $this->content = $content;
            $this->order_in_section = intval($order);
        }

        public function save(){
            global $conn;
            if($this->id == null):
                $sql = "INSERT INTO `field` 
                (`id`, 
                `section_id`, 
                `content`, 
                `content_type`, 
                `order_in_section`, 
                `label`, 
                `id_name`) 
                VALUES (NULL, 
                '".$this->section_id."', 
                '".$this->content."', 
                '".$this->content_type."', 
                '".$this->order_in_section."', 
                '".$this->label."', 
                '".$this->id_name."');";

                $result = $conn->query($sql);
                if(!$result)
                    var_dump($conn);
                $this->id = $result["id"];

            else:
                $sql = "UPDATE `field` 
                SET 
                `content` = '".$this->content."',
                `order_in_section` = '".$this->order_in_section."'                
                WHERE `field`.`id` = ".$this->id.";";
                $result = $conn->query($sql);
                if(!$result)
                    echo $result->error;
            endif;
        }
    }
?>