<?php get_header();?>
    <script type="text/javascript">

        $(document).ready(function($) {
            var loadedBlogPages = Number($.cookie('loadedBlogPages'));
            var postsPerPage;
            var count = 1;
            var isLoading = false;

            if(loadedBlogPages){
                var postsPerPageOpt = <?php echo get_option('posts_per_page')?>;
                postsPerPage = postsPerPageOpt * loadedBlogPages;
                loadArticle(count, postsPerPage);
                count = loadedBlogPages + 1;
            }
            else{
                loadArticle(count);
                count++;
            }

            var total = <?php echo $wp_query->max_num_pages; ?>;

            $(window).scroll(function(){
                if  ($(window).scrollTop() == $(document).height() - $(window).height() && !isLoading){
                    if (count > total){
                        return false;
                    }else{
                        loadArticle(count);

                        $.cookie('loadedBlogPages', count);
                    }
                    count++;
                }
            });

            function loadArticle(pageNumber, postsPerPage){
                $('div#inifiniteLoader').show();
                isLoading = true;
                $.ajax({
                    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                    type:'POST',
                    data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop&posts_per_page='+postsPerPage,
                    success: function(html){
                        $('div#inifiniteLoader').hide();
                        $("#post-main").append(html);    // This will be the div where our content will be loaded
                        isLoading = false;
                    }
                });
                return false;
            }

        });


    </script>
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
//                                if ( have_posts() ) :
//                                    // Start the Loop.
//                                    while ( have_posts() ) : the_post();
//                                        /*
//                                         * Include the post format-specific template for the content. If you want to
//                                         * use this in a child theme, then include a file called called content-___.php
//                                         * (where ___ is the post format) and that will be used instead.
//                                         */
//                                        get_template_part( 'blog-content', get_post_format() );
//
//                                    endwhile;
//                                else :
//                                    // If no content, include the "No posts found" template.
//                                    get_template_part( 'content', 'none' );
//                                endif;
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