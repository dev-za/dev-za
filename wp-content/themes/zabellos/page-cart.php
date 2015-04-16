<?php
get_header();
?>
<div class="order-content">
    <div class="container">
        <div class="row order-content-row">
            <div class="col-xs-12 col-md-8">
                <div class="row">
                    <h1>Your Cart</h1>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>

                </div>
            </div>
            <div class="hidden-xs hidden-sm col-md-4 guaranteed">
                <a href="contact-us.html">Need Help? See Customer Service</a>
                <h2>Satisfaction Guaranteed</h2>
                <p>At Zabellos, we aim to provide the highest
                    level of craftsmanship and service. If you're
                    unhappy in any way with your shoe repair
                    or purchase, we'll work with you until you're
                    completely satisfied.</p>
                <h2>Secure Shopping</h2>
                <p>Zabellos uses 128-bit Secure Sockets Layer
                    (SSL) technology to provide you with the
                    safest, most secure shopping experience
                    possible.</p>
                <img src="<?php echo get_template_directory_uri(); ?>/images/count.jpg" alt="" width="95" height="45" />
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
