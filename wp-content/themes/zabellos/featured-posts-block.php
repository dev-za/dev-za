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
</div>