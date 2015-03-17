<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

    <div class="container">
        <div class="row ">
            <div class="help-content col-xs-12">
                <div class="row">
                    <div class="col-sm-7 col-md-8 customer-service">

                        <?php the_field('customer_service'); ?>
                        <?php the_field('shipping_information'); ?>
                        <?php the_field('rush_orders'); ?>
                        <?php the_field('shipping_your_shoes'); ?>
                        <?php the_field('frequently_asked_questions'); ?>
                        <?php the_field('general_questions'); ?>
                        <?php the_field('payment_information_and_refunds'); ?>

                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="col-sm-5 col-md-4">
                        <div class="row help-contancts ">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>


<?php get_footer(); ?>