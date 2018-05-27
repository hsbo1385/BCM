<?php 

require __DIR__ . "/../web-config.php";

class ContentTypes{
    private $types = array();

    public function __construct(){
        global $conn;

        $sql = "SELECT *
                FROM content_type";
        $result = $conn->query($sql);

        //return error message if no sections found
        if(!$result->num_rows > 0)
            throw new Exception("No types found");

        foreach ($result as $type)
            array_push($this->types, $type["type"]);
    }
    public function get_content_types(){
        return $this->types;
    }
}

?>