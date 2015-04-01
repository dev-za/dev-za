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

//Show new added first
$galleryItems = array_reverse($galleryFields['gallery_items']);

//var_dump($galleryItems);

$galleryItems = array_slice($galleryItems, $itemsFrom, $itemsPerPage);

/*$thumbnails = '';
$popups = '';*/
$thumbnails = Array();
$popups = Array();
$count = 0;
foreach($galleryItems as $index => $item) {

    if(!$item['gallery_item'])
        continue;

    $count++;
//    var_dump($item);
    $thumbnail = new StdClass();
    if(!empty($item['video_frame'])){
        $thumbnail->isVideo = true;
    }
    else{
        $thumbnail->isVideo = false;
    }
    $thumbnail->url = $item['gallery_item']['url'];
    $thumbnail->alt = $item['gallery_item']['alt'];

    array_push($thumbnails, $thumbnail);

    $popup = new StdClass();
    $popup->url = $item['gallery_item']['url'];
    $popup->alt = $item['gallery_item']['alt'];
    $popup->comments = $item['comments_repeater'];
    $popup->video_frame = htmlspecialchars_decode($item['video_frame']);

    array_push($popups, $popup);
}

$response = new StdClass();
$response->thumbnails = $thumbnails;
$response->popups = $popups;
$response->loadedItems = count($galleryItems) + $loadedItems;
$response->totalItems = $totalItems;
header('Content-Type: application/json');
echo json_encode($response);
?>

