<?php
require('../../../../wp-load.php');

$response = new StdClass();

if(!empty($_POST['action'])){
    if($_POST['action'] == 'check_user_exists'){
        $response->success = true;
        $response->user_exists = true;
    }
}

header('Content-Type: application/json');

echo json_encode($response);