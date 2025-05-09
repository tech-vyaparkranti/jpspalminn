<?php
    session_start();
    include_once 'config.php'; 
    // include_once 'dbConnect.php';
    
    
    // return data -> Array ( [PayerID] => GBD3C37LXBA2G [ssrt] => 1722452592051 [flowlogging_id] => f420617ecbb83 [token] => 2XT2701986054345D [useraction] => commit [flowType] => WPS [rcache] => 1 [cookieBannerVariant] => hidden [country_x] => US,US [locale_x] => en_US,en_US )
    
    $booking_id = $_SESSION['booking_id'];
    
    if(isset($_GET['PayerID'])){
        echo "<h1>Your Payment has been successfull for booking $booking_id</h1>";
    }else{
        echo "<h1>Your Payment has been failed</h1>";
    }
    $_SESSION['booking_id'] = "";
    
    
    echo "<script>alert('payment completed');window.location.href='../index.php';</script>";
?>