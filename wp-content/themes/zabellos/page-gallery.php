<?php get_header(); ?>

<script>
    $(document).ready(function($) {
        window.loadedItems = 0;
        window.totalItems = 0;
        loadGalleryItems(window.loadedItems);
        $(window).scroll(function(){
            console.log($(document).height());
            if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                if(window.loadedItems < window.totalItems){
                    loadGalleryItems(window.loadedItems);
                }

            }
        });

        function loadGalleryItems(loadedItems){
            $('div#inifiniteLoader').show();
            $.ajax({
                url:"/wp-content/themes/zabellos/ajax/load_gallery.php",
                type: 'GET',
                data: {postID: '16', loadedItems: loadedItems},
                success: function(response) {
                    $('div#inifiniteLoader').hide();
                    $('.gallery-content .container .row').append(response.thumbnails);
                    $('.popup').append(response.popups);
                    if(response.loadedItems){
                        window.loadedItems = response.loadedItems;
                        console.log(window.loadedItems)
                    }


                    window.totalItems = response.totalItems;
                }
            });

        }
    })
</script>

    <?php global $postID; $galleryItems = get_fields($postID);?>
    <!--gallery-content-->
    <div class="gallery-content">
        <div class="container">
            <div class="row">
                <h1>Examples of our Work</h1>
                <!-- put gallery items here -->
            </div>
        </div>
    </div>
    <div id="inifiniteLoader">
        <img width="40" height="39" alt="Loading..." src="<?php bloginfo('template_directory'); ?>/images/loading.gif" />
    </div>
<!--    <p class="loading"></p>-->
    <!--popup-content-->
    <div class="popup">

    </div>

<?php get_footer()?>