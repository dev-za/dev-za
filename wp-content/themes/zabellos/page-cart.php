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
                <a href="<?php the_field('customer_service_link_url')?>"><?php the_field('customer_service_link_text')?></a>

                <h2>Satisfaction Guaranteed</h2>
                <p><?php the_field('satisfaction_guaranteed')?></p>
                <h2>Secure Shopping</h2>
                <p><?php the_field('secure_shopping')?></p>
                <img src="<?php echo get_template_directory_uri(); ?>/images/count.jpg" alt="" width="95" height="45" />
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
