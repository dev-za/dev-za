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
                                <img src="<?php echo $image['image']['url'];?>" alt="" width="871" class="img-responsive"/>
                            <?php } ?>
                        <?php } ?>
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