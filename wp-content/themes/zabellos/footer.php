        <footer>
            <div class="container">
                <div class="row">
                    <div class="clearfix">
                        <?php wp_nav_menu(array('menu' => 'top-menu', 'menu_class' => 'list-unstyled footer-nav', 'container' => false)); ?>
                        <div class="footer-social">
                            <a href="https://twitter.com" id="tw"></a>
                            <a href="https://facebook.com" id="f"></a>
                            <a href="https://instagram.com" id="o"></a>
                            <a href="https://youtube.com" id="ut"></a>
                            <a href="https://www.pinterest.com" id="p"></a>
                        </div>
                    </div>
                    <div class="clearfix" id="copyright">
                        <p class="pull-left">©2015 Zabellos, LLC. All rights reserved.</p>
                        <p class="pull-right">All shoes Repaired by Craftsmen in Los Angeles California</p>
                    </div>
                </div>
            </div>
        </footer>
</div>
<!--        div wrapper-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js"></script>
        <script type="text/javascript">

            $(document).ready(function($) {
                var loadedBlogPages = Number($.cookie('loadedBlogPages'));
                var postsPerPage;
                var count = 1;

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
                    if  ($(window).scrollTop() == $(document).height() - $(window).height()){
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
                    $.ajax({
                        url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                        type:'POST',
                        data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop&posts_per_page='+postsPerPage,
                        success: function(html){
                            $('div#inifiniteLoader').hide();
                            $("#post-main").append(html);    // This will be the div where our content will be loaded
                        }
                    });
                    return false;
                }

            });


        </script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/validate.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo get_template_directory_uri(); ?>/js/ie10-viewport-bug-workaround.js"></script>
        <?php wp_footer(); ?>
    </body>
</html>