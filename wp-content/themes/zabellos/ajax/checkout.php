<?php
require('../../../../wp-load.php');

$response = new StdClass();

if($_POST['action'] == 'check_user_exists'){
    if(!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $response->success = true;

        if(email_exists($_POST['email'])){
            $response->user_exists = true;
        }
        else{
            $response->user_exists = false;
        }

    }
    else{
        $response->success = false;
        $response->message = "Invalid email address";
    }


}
else{
    $response->success = false;
    $response->message = 'Unknown action';
}

header('Content-Type: application/json');

echo json_encode($response);