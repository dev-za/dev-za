<?php
/**
 * The main template file
 */
get_header();
?>
<!--home-content-->

<div class="home-content">
    <div class="container">
        <div class="row">
            <h1>Expert Shoe Repairs Delivered Straight to your Home <br/>
                <small>From $79. Includes free Boxes and Shipping.</small>
            </h1>
            <div class="col-xs-12">
                <div class="row">
                    <div class="home-slaider">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/slide1.jpg" alt="" width="984" height="658" class="img-responsive"/>
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