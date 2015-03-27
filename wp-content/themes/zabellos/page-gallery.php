<?php get_header(); ?>
    <?php global $postID; $galleryItems = get_fields($postID);?>
    <!--gallery-content-->
    <div class="gallery-content">
        <div class="container">
            <div class="row">
                <h1>Examples of our Work</h1>


                <?php if($galleryItems && isset($galleryItems['gallery_items'])){?>
                    <?php foreach($galleryItems['gallery_items'] as $index=>$image) { ?>
                        <div class="col-xs-6 col-sm-4">
                            <div class="gallery-img">
                                <img src="<?php echo $image['gallery_item']['url'];?>" alt="" width="305" height="305" class="img-responsive" />
                                <div class="hover-view">
                                    <a href="#" role="button" data-toggle="modal" data-target="#gallery-modal-1">View</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>


            </div>
        </div>
    </div>
    <p class="loading"></p>
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


<!--    <footer class="gallery-footer">
        <div class="container">
            <div class="row">
                <div class="clearfix">
                    <ul class="list-unstyled footer-nav">
                        <li><a href="shoe-care.html">Shoe care</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="terms.html">Terms of use</a></li>
                    </ul>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php /*echo get_template_directory_uri(); */?>/js/bootstrap.min.js"></script>
<script src="<?php /*echo get_template_directory_uri(); */?>/js/script.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php /*echo get_template_directory_uri(); */?>/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>-->