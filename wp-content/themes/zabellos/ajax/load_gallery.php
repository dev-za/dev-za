<?php
require('../../../../wp-load.php');
$itemsPerPage = 6;
$postID = $_REQUEST['postID'];
$loadedItems = ($_REQUEST['loadedItems'])?intval($_REQUEST['loadedItems']):0;


if($loadedItems)
    $itemsFrom = $loadedItems;
else
    $itemsFrom = 0;

$galleryFields = get_fields($postID);
$totalItems = count($galleryFields['gallery_items']);

$galleryItems = array_slice($galleryFields['gallery_items'], $itemsFrom, $itemsPerPage);
//var_dump($galleryFields['gallery_items']);
//sleep(1);
$thumbnails = '';
$popups = '';

foreach($galleryItems as $index => $item) {
    $thumbnails .= '<div class="col-xs-6 col-sm-4">';
    $thumbnails .=      '<div class="gallery-img">';
    $thumbnails .=          '<img src="' . $item['gallery_item']['url'] .'" alt="'.$item['gallery_item']['alt'].'"  width="381" height="382" class="img-responsive" />';
    $thumbnails .=          '<div class="hover-view">';
    $thumbnails .=              '<a href="#" role="button" data-toggle="modal" data-target="#gallery-modal-1">View</a>';
    $thumbnails .=          '</div>';
    $thumbnails .=      '</div>';
    $thumbnails .= '</div>';


    $popups .= '<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="gallery-modal-1">';
    $popups .=      '<div class="modal-dialog">';
    $popups .=          '<div class="modal-content">';
    $popups .=                 '<div class="button-close">';
    $popups .=                      '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    $popups .=                  '</div>';
    $popups .=                  '<div class="modal-body">';
    $popups .=                  '<div class="img-popup">';
    $popups .=                      '<img src="' . $item['gallery_item']['url'] .'" alt="'.$item['gallery_item']['alt'].'" class="img-responsive" />';
    $popups .=                   '</div>';
    $popups .=                   '<div class="popup-comments">';

    $comments = $item['comments_repeater'];
    foreach($comments as $key => $comment){
        $popups .=                  '<div class="item-comment '. (($key == 0)?'first-item-comment':'') . '">';
        $popups .=                    '<p>' . $comment['comment_author'] . '&nbsp';
        $popups .=                        '<time datetime="'. $comment['comment_date'] .'">' . $comment['comment_date'] .'</time>';
        $popups .=                     '</p>';
        $popups .=                    '<p>'. $comment['comment_text'].'</p>';
        $popups .=                 '</div>';

    }

    $popups .=                    '</div>';
    $popups .= '</div>';
    $popups .= '</div>';
    $popups .= '</div>';
    $popups .= '</div>';


}

$response = new StdClass();
$response->thumbnails = $thumbnails;
$response->popups = $popups;
$response->loadedItems = count($galleryItems);
$response->totalItems = $totalItems;
header('Content-Type: application/json');
echo json_encode($response);
?>

