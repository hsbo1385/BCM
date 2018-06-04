<div id="section-<?=$section->get_id()?>" class="landing">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="menu">
                    <?php
                    foreach ($content as $section):
                        if($section->is_in_menu()):
                        ?>
                            <a onclick="scrollToSection(<?=$section->get_id()?>)"><?=$section->get_display_name()?></a>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </nav>
            </div>
            <div class="offset-md-5 col-md-7 col-12">
                <div class="landing-content">
                    <h1>
                        <?=$fields[$c++]->get_content()?>
                    </h1>
                    <p>
                        <?=$fields[$c++]->get_content()?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>