<?php
get_header(); ?>

    <div class="content-how-it-works">
        <div class="container">
            <div class="row">
                <?php the_field('page_title');?>
                <div class="col-sm-12">
                    <div class="how-back-mobile">
                        <?php global $postID; $postFields = get_fields($postID);?>
                        <?php if($postFields && isset($postFields['content_images'])){?>
                            <?php foreach($postFields['content_images'] as $index=>$image) {?>
                            <?php //AKA: нужно убрать прописывание ширины ?>
                                <img src="<?php echo $image['image']['url'];?>" alt="" class="img-responsive"/>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <?php the_field('page_text')?>
                </div>
                <?php //the_field('repair_now_button')?>
                <?php

                $product = get_field('product');
                if($product):?>
                    <a href="<?php echo home_url()?>/?add-to-cart=<?php echo $product->ID?>" class="btn btn-danger btn-lg"><?php the_field('button_text')?></a>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
