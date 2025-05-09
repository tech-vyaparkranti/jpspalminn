<?php
    session_start();
    $session_id = session_id();
    include("../admin/database/database.php");
    
    date_default_timezone_set('Asia/Kolkata');
    $dat_asia = date('Y-m-d');
    $tym_asia = date('Y-m-d H:i:s');
    
    $cart_id = $_GET['cart_id'];
    $adults = $_GET['adults'];
    $childs = $_GET['children'];
    $childs_details = $_GET['childs_details'];
    
    
    $sel_cart = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `cart` WHERE id=$cart_id"));
    $room_id = $sel_cart['room_id'];
    $room_details = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `rooms` WHERE id=$room_id"));
    
    
    $base_adult = $room_details['base_adult'];
    $base_child = $room_details['base_child'];
    $extra_adult_price = $room_details['extra_adult_price'];
    $extra_child_5_9_price = $room_details['extra_child_5_9_price'];
    $extra_child_10_price = $room_details['extra_child_10_price'];
    $breakfast = $room_details['breakfast'];
    $extra_adult_breakfast_price = $room_details['extra_adult_breakfast_price'];
    $extra_child_5_9_breakfast_price = $room_details['extra_child_5_9_breakfast_price'];
    $extra_child_10_breakfast_price = $room_details['extra_child_10_breakfast_price'];
    
    
    $Uextra_adult_price = $Uextra_child_price = 0;
    $room_price = $sel_cart['room_price'];
    $nights = $sel_cart['nights'];
    
    
    
    if($adults>$base_adult){
        $Uextra_adult_price = $extra_adult_price;
        if($breakfast){
            $Uextra_adult_price+=$extra_adult_breakfast_price;
        }
    }
    
    if($childs>$base_child){
        $Uextra_child_price = 0;
        $selected_childs_age = explode(",",$childs_details);
        
        $cnt_extra_child = 0;
        
        foreach ($selected_childs_age as $age) {
            $cnt_extra_child++;
            if($cnt_extra_child>$base_child){
                if($age>=5 and $age<10){
                    $Uextra_child_price+= $extra_child_5_9_price;
                    if($breakfast){
                        $Uextra_child_price+=$extra_child_5_9_breakfast_price;
                    }
                }elseif($age>=10){
                    $Uextra_child_price+= $extra_child_10_price;
                    if($breakfast){
                        $Uextra_child_price+=$extra_child_10_breakfast_price;
                    }
                }
            }
        }
    }
    
    
    $total_price = ($room_price + $Uextra_adult_price  + $Uextra_child_price)*$nights;
    
    mysqli_query($link,"UPDATE `cart` SET  `adults`='$adults',`childs`='$childs',`childs_details`='$childs_details',`extra_adult_price`='$Uextra_adult_price',`extra_child_price`='$Uextra_child_price',`total_price`='$total_price',`updated_at`='$dat_asia' WHERE id=$cart_id and session_id='$session_id'");
?>
