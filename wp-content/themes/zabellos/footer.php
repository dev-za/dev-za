        <footer>
            <div class="container">
                <div class="row">
                    <div class="clearfix">
                        <?php wp_nav_menu(array('menu' => 'bottom-menu', 'menu_class' => 'list-unstyled footer-nav', 'container' => false)); ?>
                        <?php //AKA: все социалки нужно вынести в админку в настройки футера?>
                        <div class="footer-social">
                            <a href="https://twitter.com" id="tw"></a>
                            <a href="https://facebook.com" id="f"></a>
                            <a href="https://instagram.com" id="o"></a>
                            <a href="https://youtube.com" id="ut"></a>
                            <a href="https://www.pinterest.com" id="p"></a>
                        </div>
                    </div>
                    <div class="clearfix" id="copyright">
                        <?php //AKA: нужно вынести в админку в настройки футера?>
                        <p class="pull-left">©2015 Zabellos, LLC. All rights reserved.</p>
                        <p class="pull-right">All shoes Repaired by Craftsmen in Los Angeles California</p>
                    </div>
                </div>
            </div>
        </footer>
</div>
<!--        div wrapper-->



        <script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php echo get_template_directory_uri(); ?>/js/ie10-viewport-bug-workaround.js"></script>
        <?php wp_footer(); ?>
    </body>
</html>
