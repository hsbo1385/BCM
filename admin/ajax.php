<?php
require_once __DIR__ . "/../includes/items/section.php";

$input = $_REQUEST["input"];

switch($input["action"]){
    case "upsert_data":
        upsert_data($input);    
        break;
    case "create_section":
        create_section($input);
        break;
    case "delete_field":
        delete_field($input);
        break;
    case "delete_section":
        delete_section($input);
        break;
    default:
        echo 'Action does not exist';
        header('HTTP/1.1 400 Bad Request');
        break;
}

function delete_field($input){
    $input = $input["fieldId"];
    Field::delete_field($input);
}

function upsert_data($input){
    $fields = $input;

    $newSection = Section::find_section($input["section_id"]);
    $newSection->update_section($input["section_template"], $input['section_order'], $input['section_menu_status']);
    $newSection->save();
    unset($fields['section_id'], $fields["section_template"], $fields['section_order'], $fields["action"], $fields['section_menu_status']);   

    foreach($fields as $field):
        $newField;
        if(isset($field["id"])):
            $newField = Field::find_field($field["id"]);
            $newField->update_content_and_order($field["content"], intval($field["order"]));
        else:
            $newField = new Field($field);
        endif;
        $newField->save();
    endforeach;
    return http_response_code(200);
    die();
}

function create_section($section){
    $newSection = new Section($section["section[1"]);
    $newSection->save(); 
    die();
}

function delete_section($section){
    $section = $section["sectionId"];
    Section::delete_section($section);
    die();
}
?>