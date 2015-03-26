<?php
get_header();
?>

<div class="home-content">
    <div class="container">
        <div class="row">
            <?php the_field('title_block')?>
            <div class="col-xs-12">
                <div class="row">
                    <div class="home-slaider">
                        <link href="<?php echo get_template_directory_uri(); ?>/css/fotorama/fotorama.css" rel="stylesheet">
                        <script src="<?php echo get_template_directory_uri(); ?>/js/fotorama.js"></script>
                        <?php global $postID; $postFields = get_fields($postID);?>
                        <div class="fotorama" data-width="984"  data-max-width="100%" data-nav="false" data-autoplay="3000">
                            <?php if($postFields && isset($postFields['images'])){?>
                                <?php

                                foreach($postFields['images'] as $index=>$image) {?>
                                    <img src="<?php echo $image['image']['url'];?>" alt="" width="984" class="img-responsive"/>
                                <?php }
                                ?>
                            <?php } ?>
                        </div>
<!--                        <img src="--><?php //echo get_template_directory_uri(); ?><!--/images/slide1.jpg" alt="" width="984" height="658" class="img-responsive"/>-->


                        <div class="home-slider-pagination">
                            <div class="home-paginations-a">
                                <a class="prev">&lsaquo;</a>
                                <a class="next">&rsaquo;</a>
                            </div>
                        </div>
                        <div class="home-quation clearfix">
                            <a href="order.html" class="btn btn-danger btn-lg">Repair Now</a>
                            <p class="p-quation">Have questions? Call toll free (888) 556-0172<br/> or <a href="contact-us.html">contact us</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php get_footer();?>