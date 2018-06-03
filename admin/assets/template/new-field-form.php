<?php 
    require_once __DIR__ . "/../../../includes/data.php";
    $sections = get_all_sections_for_page();
?>
<div class="new-item pos-rel">
    <div class="new-item-form pos-abs-XY">
        <form onsubmit="submitData(event, this);" class="item-form field">
            <h3>
                New Field
            </h3>
            <div class="form-item">
                <label for="field[1][label]">Field label</label>
                <input type="text" name="field[1][label]">
            </div>
            <div class="form-item">
                <label for="field[1][content_type]">Content Type</label>
                <select name="field[1][content_type]">
                    <?php
                        $content_types = get_content_types();
                        $content_types = $content_types->get_content_types();

                        foreach ($content_types as $type):
                        ?>
                            <option value="<?=strval($type)?>">
                                <?=strval($type)?>
                            </option>
                        <?php
                        endforeach;
                    ?>
                </select>
            </div>
            <div class="form-item">
                <label for="field[1][section_id]">Section</label>
                <select name="field[1][section_id]">
                    <?php
                        foreach ($sections as $section):
                        ?>
                            <option value="<?=$section->get_id()?>">
                                <?=$section->get_display_name()?>
                            </option>
                        <?php
                        endforeach;
                    ?>
                </select>
            </div>
            <div class="submit-container"> 
                <button type="submit" class="bcm-btn ml-15">Save</button>
                <button onclick="toggleNewFieldForm(event)" class="bcm-btn red">Close</button>
            </div>
        </form>
    </div>
</div>