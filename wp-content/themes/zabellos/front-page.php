<?php
get_header();
?>

<script  type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery-ui.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/home_slider.js"></script>
<div class="home-content">
    <div class="container">
        <div class="row">
            <h1><?php the_field('main_title')?><br>
                <small><?php the_field('sub_title')?></small></h1>

            <div class="col-xs-12">
                <div class="row">
                    <div class="home-slaider">
                        <div class='slider-viewport'>
                            <?php global $postID; $postFields = get_fields($postID);?>
                            <ul class='slidewrapper' data-current=0>
                                <?php
                                if($postFields && isset($postFields['images'])){
                                    for($i=count($postFields['images'])-1; $i >= 0; $i--) {
                                        $image = $postFields['images'][$i]['image'];

                                        if($image){ ?>
                                            <li class="slide" style="background-image: url(<?php echo $image['url'];?>)"></li>
                                            <!--<li class='slide'>
                                                <img src="<?php /*echo $image['url'];*/?>" alt="" width="<?php /*echo $image['width'];*/?>" height="<?php /*echo $image['height'];*/?>" class="img-responsive"/>
                                            </li>-->
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>

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