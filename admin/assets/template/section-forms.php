<?php 
    require __DIR__ . "/../../../includes/data.php";

    $sections = get_all_sections_for_page();
?>
<!-- navigation for content -->
<nav class="navigation">
    <?php 
    $firstSection = true;
    foreach ($sections as $section) :?>
    <a onclick="switchSection(<?=$section->get_id()?>)" class="section-<?=$section->get_id()?>-button content-link<?=($firstSection)?" active":null?>" >
        <?=$section->get_display_name()?>
    </a>
    <?php
    $firstSection = false;
    endforeach; ?>
</nav>
<!-- data editing section -->
<div class="section-data">
    <?php 
    //loop through all sections
    $firstSection = true;
    foreach ($sections as $section) :?>
    <div class="section-form section-<?=$section->get_id()?><?=($firstSection)? null : " hide"?>" section-name="<?=$section->get_name()?>">
        
        <!-- section <?=$section->get_name()?> title -->
        <h2><?=$section->get_display_name()?></h2>
        
        <form onsubmit="event.preventDefault(); submitData(this);" class="item-form">
            <input type="hidden" name="section_id" value="<?=$section->get_id()?>">
            <?php 
            $firstSection = false;
            $fieldCounter = 1;
            //loop through all fields in section
            $fields = $section->get_fields();
            foreach ($fields as $field):
                ?>
                <div class="form-item">
                    <div class="delete-button">
                        <a class="delete-field" onclick="deleteField(<?=$field->get_id() .", '" . $field->get_label() . "', '" . $section->get_display_name()?>')">
                            -
                        </a>
                    </div>
                    <label class="big-label"><?=$field->get_label()?></label>
                    <input type="hidden" name="field[<?=$fieldCounter?>][id]" value="<?=$field->get_id()?>">
                    <?php
                        //use input type according to content type 
                        switch(strtolower($field->get_content_type())){
                            case 'text': ?>
                                <input type="text" name="field[<?=$fieldCounter?>][content]" placeholder="Text for <?=$field->get_label()?>" value="<?=$field->get_content()?>">
                                <?php
                                break;
                            case "textbox": ?>
                                <textarea name="field[<?=$fieldCounter?>][content]" rows="6" ><?=$field->get_content()?></textarea>
                                <?php
                                break;
                        }
                    ?>
                    <label class="small-label" for="field[<?=$fieldCounter?>][order]">Order</label>
                    <input type="number" name="field[<?=$fieldCounter?>][order]" value="<?=$field->get_order()?>">
                </div>
                <?php
                $fieldCounter++;
            endforeach;
            ?>
            
            <?php 
            $templates = scandir(__DIR__.'/../../../includes/template/sections');
            //always delete first 2 files (. and ..)
            $templates = array_slice($templates, 2);
            ?>
            <div class="form-item">
                <label class="big-label" for="template">
                    Section Template
                </label>
                <select name="section_template">
                <?php
                //show all templates in dropdown menu from template/sections directory
                foreach($templates as $file):
                    $t = $file;
                    if(substr($file, 0, 8) == "section-")
                    $t = substr($file, 8);
                    $t = substr($t, 0, -4);
                    ?>
                    <option value="<?=$t?>" <?=($t==$section->get_template_name())? 'selected="selected"' : null ?>><?=ucfirst($t)?></option>
                    <?php
                endforeach;
                ?>
                </select>
            </div>
            <div class="form-item">
                <a class="add-new-field pos-rel" onclick="toggleNewFieldForm()">
                    <div class="horizontal line pos-abs-XY"></div>
                    <div class="vertical line pos-abs-XY"></div>
                </a>
            </div>
            <!-- submit and response message -->
            <div id="section-<?=$section->get_id()?>-submit" class="submit-container">
                <div class="message">
                    <div class="confirm hide">
                        Changes saved.
                    </div>
                    <div class="error hide">
                        Error occured.
                    </div>
                    <div class="deleted hide">
                        Item deleted.
                    </div>
                    <div class="other-message hide">

                    </div>
                </div>
                <div class="submit loading pod-rel hide">
                    <div class="loading-icon pos-abs-XY">
                        <img src="assets/img/animation-pebble.png" class="part-1">
                        <img src="assets/img/animation-pebble.png" class="part-2">
                        <img src="assets/img/animation-pebble.png" class="part-3">
                    </div>
                </div>
                <input type="submit" class="bcm-btn" value="Save">
            </div>
        </form>
    </div>
    <?php endforeach; ?>    
</div>