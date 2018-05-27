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
    <!-- header -->
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
    <!-- content box -->
    <div class="content">
        <div id="form-output" class="container">
        <?php 
            require "assets/template/section-forms.php";
        ?>
        </div>
    </div>
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
    <div class="new-item-container fullscreen hide">
        <div class="new-item pos-rel">
            <div class="new-item-form pos-abs-XY">
                <form onsubmit="event.preventDefault(); submitData(this);" class="item-form field">

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
                    <div id="section-new-item-submit" class="submit-container"> 
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
                        <button type="submit" class="bcm-btn">Save</button>
                        <button onclick="toggleNewFieldForm()" class="bcm-btn red">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/trumbowyg.min.js"></script>
    <script src="assets/bcm-js.js"></script>
    <script>
        $('textarea').trumbowyg();
    </script>
</body>
</html>
