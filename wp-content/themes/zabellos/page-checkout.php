<?php
get_header();
?>

<div class="container-checkout">
    <div class="container">
        <div class="row">
            <a href="order.html" class="back hidden-xs hidden-sm"><span></span>Back to Cart</a>
            <div class="clearfix checkout-header">
                <h1 class="pull-left">Checkout</h1>
                <a class="pull-right hidden-xs hidden-sm" href="<?php the_field('customer_service_link_url')?>"><?php the_field('customer_service_link_text')?></a>
            </div>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    </div>

</div>
<?php get_footer();?>
