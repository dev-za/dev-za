<?php
get_header(); ?>

    <div class="content-how-it-works">
        <div class="container">
            <div class="row">
                <?php the_field('page_title');?>
                <div class="col-sm-12">
                    <div class="how-back-mobile">
                        <?php get_field('image1');?>
                        <img src="<?php the_field('image1')?>" alt="" width="871" height="279" class="img-responsive"/>
                        <img src="<?php the_field('image2')?>" alt="" width="871" height="236" class="img-responsive" />
                    </div>
                </div>
                <div class="col-sm-12">
                    <?php the_field('page_text')?>
                </div>
                <?php the_field('repair_now_button')?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>