<?php get_header();?>
    <!--content-blog-->
    <div class="container">
        <div class="row">
            <div class="content-blog col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-md-4 blog-posts">
                        <div class="featured-posts back-c">
                            <h2>Featured Posts</h2>
                            <ul class="list-unstyled">
                                <?php
                                do_action( 'zabellos_featured_posts_before' );
                                $featured_posts = zabellos_get_featured_posts();
                                $postCnt = 0;
                                foreach ( (array) $featured_posts as $order => $post ) :
                                    $postCnt++;
                                    setup_postdata( $post );
                                    if($postCnt > 3){?>
                                        <div class="hidden-xs hidden-sm">
                                    <?php
                                    }
                                    // Include the featured content template.
                                    get_template_part( 'featured-content', 'featured-post' );


                                endforeach;
                                // close <div class="hidden-xs hidden-sm">
                                if($postCnt > 3){?>
                                        </div>
                                <?php
                                }
                                do_action( 'zabellos_featured_posts_after' );
                                wp_reset_postdata();
                                ?>
                            </ul>
                        </div><!-- #featured-content .featured-content -->
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="row">
                            <div class="post-main">
                                <?php
                                if ( have_posts() ) :
                                    // Start the Loop.
                                    while ( have_posts() ) : the_post();
                                        /*
                                         * Include the post format-specific template for the content. If you want to
                                         * use this in a child theme, then include a file called called content-___.php
                                         * (where ___ is the post format) and that will be used instead.
                                         */
                                        get_template_part( 'content', get_post_format() );

                                    endwhile;
                                else :
                                    // If no content, include the "No posts found" template.
                                    get_template_part( 'content', 'none' );
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>