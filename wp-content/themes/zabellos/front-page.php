<?php
get_header();
?>

<div class="home-content">
    <div class="container">
        <div class="row">

            <h1><?php the_field('main_title')?><br>
                <small><?php the_field('sub_title')?></small></h1>

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
                            <a href="order.html" class="btn btn-danger btn-lg"><?php the_field('button_text')?></a>
                            <p class="p-quation"><?php the_field('have_a_question_text')?><br/> or  <a href="<?php the_field('contact_as_link')?>">contact us</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php get_footer();?>