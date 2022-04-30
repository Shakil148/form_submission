<?php
require_once('application/model/Buyer.php');
require_once('application/Validation.php');

$action = "";
if(! empty($_GET["action"])){
    $action = $_GET["action"];
}


if($action=="buyer-add"){
    if (isset($_POST['add'])) {
        $validation = new Validation();
        $validity = $validation->validator($_POST);
        if($validity['resp_code'] == 1){
            require_once('view/buyer/create.php');
        }else{
            $buyer = new Buyer();
            if($_COOKIE['buyer_creation'] != 110105){
                $buyerId = $buyer->create($_POST);
                if($buyerId){
                    setcookie('buyer_creation', 110105, time()+86400);
                    $result = $buyer->index();
                    require_once('view/buyer/index.php');
                }
            }else{
                $validity['resp_code'] = 1;
                $validity['message'] = 'You can not create another one within 24 hours.';
                require_once('view/buyer/create.php');
            }
        }
    }
    require_once("view/buyer/create.php");
}else{
    $buyer = new Buyer();
    if(isset($_GET['search'])){
        $validation = new Validation();
        $validity = $validation->searchValidator($_GET);
        if($validity['resp_code'] == 0){
            $result = $buyer->search($_GET);
        }
    }else{
        $result = $buyer->index();
    }
    require_once('view/buyer/index.php');
}