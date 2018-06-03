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
    if($firstSection): ?>
    <script>
        firstSection = <?=$section->get_id()?>;
    </script>
    <?php
    endif;
    $firstSection = false;
    endforeach; ?>
    <a onclick="toggleNewSectionForm(event)" class="add-section-button content-link">+ Add section</a>
</nav>
<!-- data editing section -->
<div class="section-data">
    <?php 
    //loop through all sections
    $firstSection = true;
    foreach ($sections as $section) :?>
    <div class="section-form section-<?=$section->get_id()?><?=($firstSection)? null : " hide"?>">
        
        <!-- section <?=$section->get_display_name()?> title -->
        <h2><?=$section->get_display_name()?></h2>
        
        <form onsubmit="submitData(event, this);" id="section-form-<?=$section->get_id()?>" class="item-form" enctype="multipart/form-data">
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
                            case "image":?>
                                <div class="file-item pos-rel bcm-btn">
                                    Upload File
                                    <input type="file" name="field[<?=$fieldCounter?>][content]">
                                </div>
                                <img src="<?=$field->get_content()?>" alt="">
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
            <div class="form-item section-update">
                <div class="third">
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
                <div class="third">
                    <label class="big-label" for="section_order">
                        Page Order
                    </label>
                    <input type="number" name="section_order" value="<?=$section->get_order()?>">
                </div>
                <div class="third">
                    <label class="big-label" for="section_menu_status">
                        In Menu
                    </label>
                        <?php
                        $isInMenu = (intval($section->is_in_menu()) === 0);
                        ?>
                    <select name="section_menu_status">
                        <option value="1" <?=(intval($section->is_in_menu()) == 1) ? "selected='selected'" : ""?>>Yes</option>
                        <option value="0" <?=(intval($section->is_in_menu()) == 0) ? "selected='selected'" : ""?>>No</option>
                    </select>
                </div>
            </div>
            <div class="form-item">
                <a class="add-new-field pos-rel" onclick="toggleNewFieldForm(event)">
                    <div class="horizontal line pos-abs-XY"></div>
                    <div class="vertical line pos-abs-XY"></div>
                </a>
            </div>
            <!-- submit and response message -->
            <div id="section-<?=$section->get_id()?>-submit" class="submit-container">
                <button onclick="deleteSection(event, <?=$section->get_id()?>, '<?=$section->get_display_name()?>')" class="bcm-btn red ml-15">Delete Section</button>
                <button type="submit" class="bcm-btn">Save</button>
            </div>
        </form>
    </div>
    <?php endforeach; ?>    
</div>