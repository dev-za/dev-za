<?php
require('../../../../wp-load.php');
$postID = $_POST['postID'];
$galleryItems = get_fields($postID);
sleep(1);
?>
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