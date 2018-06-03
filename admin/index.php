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
            require_once "assets/template/section-forms.php";
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
        <?php 
            require_once "assets/template/new-field-form.php";
            ?>
    </div>
    <!-- new field form end -->
    <!-- new section form start -->
    <div class="new-section-container fullscreen hide">
        <?php
            require_once "assets/template/new-section-form.php";
            ?>
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
    <!-- javascripts -->
    <script src="assets/jquery-3.3.1.min.js"></script>
    <script src="assets/trumbowyg.min.js"></script>
    <script src="assets/bcm-js.js"></script>
    <script>
        $('textarea').trumbowyg();
    </script>
</body>
</html>
