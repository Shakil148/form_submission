<?php
require_once('application/model/Buyer.php');
require_once('application/Validation.php');
header('Content-type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validation = new Validation();
    $validity = $validation->validator($_POST);
    if($validity['resp_code'] == 1){
        echo json_encode($validity);
    }else{
        $buyer = new Buyer();
        if(isset($_COOKIE['buyer_creation'])){
            if($_COOKIE['buyer_creation'] != 110105){
                $buyerId = $buyer->create($_POST);
                if($buyerId){
                    setcookie('buyer_creation', 110105, time()+86400);
                    echo json_encode(['resp_code' => 0, 'code'=> 200, 'message' => 'Your data has been inserted successfully.']);
                }
            }else{
                echo json_encode(['resp_code' => 1, 'code'=> 406, 'message' => 'You can not generate another receipt within 24 hours']);
                
            }
        }else{
            $buyerId = $buyer->create($_POST);
            if($buyerId){
                setcookie('buyer_creation', 110105, time()+86400);
                echo json_encode(['resp_code' => 0, 'code'=> 200, 'message' => 'Your data has been inserted successfully.']);
            }
        }
    }
}