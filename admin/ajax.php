<?php
require_once __DIR__ . "/../includes/items/field.php";

$input = $_POST["input"];

foreach($input as $field){
    if(is_string($field))
        if(check_injection($field))
            return http_response_code(400);
    else
        foreach ($field as $subfield) 
            if(check_injection($subfield))
                return http_response_code(400);
}

switch($input["action"]){
    case "upsert_data":
        upsert_data($input);    
        break;
    case "delete_field":
        delete_field($input);
        break;
    default:
        return http_response_code(400);
        break;
}

function delete_field($input){
    $input = $input["fieldId"];
    Field::delete_field($input);
}

function upsert_data($input){
    //save fields data
    $fields = $input;

    //save section data
    if(isset($input["section_id"])):
        $section = array(
            "id" => $input["section_id"],
            "template" => $input["section_template"]
        );
        //delete section data from fields
        unset($fields['section_id'], $fields["section_template"], $fields["action"]);   
    endif;
    //foreach field, if field includes an id, find the field in the database
    //else, create new field object and populate with all sent data
    foreach($fields as $field):
        $newField;
        if(isset($field["id"])):
            $newField = Field::find_field($field["id"]);
            $newField->update_content_and_order($field["content"], intval($field["order"]));
        else:
            $newField = new Field($field);
        endif;
        //save the edited Field instance
        $newField->save();
    endforeach;
    return http_response_code(200);
    die();
}

function check_injection($string){
    return (strpos($string, ";") !== false || strpos($string, "--") !== false);
}
?>