<?php
if(count($fields) > 0):
?>

<div id="section-<?=$section->get_id()?>" class="contact">
    <div class="container">
        <div class="row">
        <?php
            if($fields[$c]):
            ?>
            <div class="col-6">
                <h2><?=$fields[$c]->get_content()?></h2>
            </div>
            <?php 
            endif;
            $c++;
            if($fields[$c]):
            ?>
            <div class="col-6">
                <p>
                    <?=$fields[$c]->get_content()?>
                </p>
            </div>
            <?php
            endif;
            $c++;
            if($fields[$c]):
            ?>
            <div class="col-12">
                <p>
                    <?=$fields[$c]->get_content()?>
                </p>
            </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>
<?php 
endif;
?>