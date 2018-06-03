<?php 
    require_once __DIR__ . "/../../../includes/data.php";
    $sections = get_all_sections_for_page();
?>

<div class="new-item pos-rel">
    <div class="new-item-form pos-abs-XY">
        <form onsubmit="submitDataSection(event, this);" class="item-form field">
            <h3>
                New Section
            </h3>
            <div class="form-item">
                <label for="display_name">Section Name</label>
                <input type="text" name="display_name">
            </div>
            <?php 
                $templates = scandir(__DIR__.'/../../../includes/template/sections');
                //always delete first 2 files (. and ..)
                $templates = array_slice($templates, 2);
                ?>
            <div class="form-item">
                <label class="big-label" for="template">
                    Section Template
                </label>
                <select name="template">
                <?php
                //show all templates in dropdown menu from template/sections directory
                foreach($templates as $file):
                    $t = $file;
                    if(substr($file, 0, 8) == "section-")
                    $t = substr($file, 8);
                    $t = substr($t, 0, -4);
                    ?>
                    <option value="<?=$t?>"><?=ucfirst($t)?></option>
                    <?php
                endforeach;
                ?>
                </select>
            </div>
            <div class="submit-container"> 
                <button type="submit" class="bcm-btn ml-15">Save</button>
                <button onclick="toggleNewSectionForm(event)" class="bcm-btn red">Close</button>
            </div>
        </form>
    </div>
</div>