<?php
    session_start();
    $session_id = session_id();
    include("../admin/database/database.php");
    
    $room_id = $_GET['room_id'];
    
    if($room_id!='undefined'){
        mysqli_query($link,"DELETE FROM `cart` WHERE room_id=$room_id and session_id='$session_id'");
    }else{
        mysqli_query($link,"DELETE FROM `cart` WHERE  session_id='$session_id'");
    }
?>
