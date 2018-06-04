<div id="section-<?=$section->get_id()?>" class="services">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2><?=$fields[$c++]->get_content()?></h2>
                <p>
                    <?=$fields[$c++]->get_content()?>
                </p>
            </div>
            <?php 
                $fields = array_slice($fields, 2);
                foreach ($fields as $field):
                ?>
                    <div class="col-md-4 col-6">
                        <div class="single-service">
                            <?=$field->get_content()?>
                        </div>
                    </div>
                <?php
                endforeach;
            ?>
        </div>
    </div>
</div>