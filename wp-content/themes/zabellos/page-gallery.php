<?php get_header(); ?>

<script>
    $('div#inifiniteLoader').show();
    $.ajax({
        url:"/wp-content/themes/zabellos/ajax/load_gallery.php",
        type: 'POST',
        data: {postID: '16'},
        success: function(response) {
            $('div#inifiniteLoader').hide();
            $('.gallery-content .container .row').append(response);
        }
    });

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
        <?php if($galleryItems && isset($galleryItems['gallery_items'])){?>
            <?php foreach($galleryItems['gallery_items'] as $index=>$item) { ?>

                <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="gallery-modal-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="button-close">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="img-popup">
                                    <img src="<?php echo $item['gallery_item']['url'];?>" alt="" width="305" height="306" class="img-responsive" />
                                </div>
                                <div class="popup-comments">

                                    <?php
                                        $comments = $item['comments_repeater'];
                                        foreach($comments as $key => $comment){?>
                                            <div class="item-comment <?php echo ($key == 0)?'first-item-comment':''?>">
                                                <p><?php echo $comment['comment_author']?>&nbsp;
                                                    <time datetime="<?php echo $comment['comment_date']?>"><?php echo $comment['comment_date']?></time></p>
                                                <p><?php echo $comment['comment_text']?></p>
                                            </div>
                                    <?php
                                        }
                                    ?>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>
        <!--#gallery-modal-1-->
    </div>

<?php get_footer()?>