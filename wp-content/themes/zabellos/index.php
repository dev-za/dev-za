<?php get_header();?>
    <!--content-blog-->
    <div class="container">
        <div class="row">
            <div class="content-blog col-xs-12">
                <div class="row">
                    <div class="col-xs-12 col-md-4 blog-posts">
                        <?php get_template_part('featured-posts-block', '');?>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <div class="row">
                            <div id="post-main" class="post-main">
                                <?php
                                if ( have_posts() ) :
                                    // Start the Loop.
                                    while ( have_posts() ) : the_post();
                                        /*
                                         * Include the post format-specific template for the content. If you want to
                                         * use this in a child theme, then include a file called called content-___.php
                                         * (where ___ is the post format) and that will be used instead.
                                         */
                                        get_template_part( 'blog-content', get_post_format() );

                                    endwhile;
                                else :
                                    // If no content, include the "No posts found" template.
                                    get_template_part( 'content', 'none' );
                                endif;
                                ?>
                            </div>
                            <div id="inifiniteLoader">
                                <img width="40" height="39" alt="Loading..." src="<?php bloginfo('template_directory'); ?>/images/loading.gif" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>