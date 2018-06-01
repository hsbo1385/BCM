<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BCM Admin</title>
    <link rel="stylesheet" href="assets/trumbowyg.min.css">
    <link rel="stylesheet" href="assets/bcm-style.css">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
</head>
<body>
    <!-- loading screen -->
    <div id="loading" class="loading fullscreen">
        <div class="loading-icon pos-abs-XY">
            <img src="assets/img/animation-pebble.png" class="part-1">
            <img src="assets/img/animation-pebble.png" class="part-2">
            <img src="assets/img/animation-pebble.png" class="part-3">
        </div>
    </div>
    <!-- header start -->
    <header>
        <div class="logo">
            <div class="container header">
                <img src="assets/img/bcm-logo.png" alt="BCM logo">
                <div class="link">
                    <a href="/" class="bcm-btn red">Back to site</a>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    <!-- content box start-->
    <div class="content">
        <div id="form-output" class="container">
        <?php 
            require "assets/template/section-forms.php";
        ?>
        </div>
    </div>
    <!-- content box end -->
    <!-- confirmation window start -->
    <div class="confirmation-window fullscreen hide">
        <div class="confirmation-dialog pos-rel">
            <div class="dialog pos-abs-XY">
                <p></p>
                <div class="response-buttons">
                    <button class="confirm">
                        Yes
                    </button>
                    <button class="cancel">
                        No
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- confirmation window end -->
    <!-- new field form start -->
    <div class="new-item-container fullscreen hide">
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
    </div>
    <!-- new field form end -->
    <!-- new section form start -->
    <div class="new-section-container fullscreen hide">
        <div class="new-item pos-rel">
            <div class="new-item-form pos-abs-XY">
                <form onsubmit="submitDataSection(event, this);" class="item-form field">
                    <h3>
                        New Section
                    </h3>
                    <div class="form-item">
                        <label for="section[1][display_name]">Section Name</label>
                        <input type="text" name="section[1][display_name]">
                    </div>
                    <?php 
                        $templates = scandir(__DIR__.'/../includes/template/sections');
                        //always delete first 2 files (. and ..)
                        $templates = array_slice($templates, 2);
                        ?>
                    <div class="form-item">
                        <label class="big-label" for="section1[1][template]">
                            Section Template
                        </label>
                        <select name="section[1][template]">
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
    </div>
    <div id="request-loading" class="hide">
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
        <div class="loading-icon">
            <img src="assets/img/animation-pebble.png" class="part-1">
            <img src="assets/img/animation-pebble.png" class="part-2">
            <img src="assets/img/animation-pebble.png" class="part-3">
        </div>
    </div>
    <!-- new section form end -->
    <!-- javascripts -->
    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/trumbowyg.min.js"></script>
    <script src="assets/bcm-js.js"></script>
    <script>
        $('textarea').trumbowyg();
    </script>
</body>
</html>
