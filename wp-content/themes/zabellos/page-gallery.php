<?php get_header(); ?>
<script src="<?php bloginfo('template_directory'); ?>/js/moment.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/gallery.js"></script>
    <!--gallery-content-->
    <div class="gallery-content">
        <div class="container">
            <div class="row">
                <h1>Examples of our Work</h1>
                <!-- gallery items will be here -->
            </div>
        </div>
    </div>
    <div id="inifiniteLoader">
        <?php //AKA: нужно убрать прямое прописывание ?>
        <img width="40" height="39" alt="Loading..." src="<?php bloginfo('template_directory'); ?>/images/loading.gif" />
    </div>
    <!--popup-content-->
    <div class="popup">
        <!--   popups will be here     -->
    </div>

<?php get_footer()?>
