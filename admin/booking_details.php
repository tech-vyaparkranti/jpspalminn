<?php
    include("database/database.php");
    $id = $_GET['id'];
    
    $sel_booking = mysqli_query($link,"SELECT * FROM `bookings` where id=$id");
    if(mysqli_num_rows($sel_booking)){
        $booking_details = mysqli_fetch_assoc($sel_booking);
        
        $booking_id = $booking_details['booking_id'];
        $name = $booking_details['name'];
        $mobile = $booking_details['mobile'];
        $email = $booking_details['email'];
        $total = $booking_details['total'];
        $pay_mode = $booking_details['pay_mode'];
        $payment_id = $booking_details['payment_id'];
        $booked_on = $booking_details['booked_on'];
        $checkin = $booking_details['checkin'];
        $checkout = $booking_details['checkout'];
        $nights = $booking_details['nights'];
        $payment_status = $booking_details['payment_status'];
        
        $dat_view = date("d M Y", strtotime($booked_on));
        $dat_sort = date('Ymd', strtotime($booked_on));
        
        if($pay_mode==1){
            $pay_mode = "Online";
        }else{
            $pay_mode = "Admin";
        }
        
        $checkin_details = "Checkin- ";
        $checkin_details.=date("d M Y", strtotime($checkin));
        $checkin_details.="<br>Checkout- ";
        $checkin_details.=date("d M Y", strtotime($checkout));
        $checkin_details.="<br>Nights- $nights";

        
        $payment_details = "Total Amount - <b>$total</b><br> Mode - <b>$pay_mode</b><br>  Payment ID - <b>$payment_id</b><br> ";
        
        if($payment_status==1){
            $payment_details.="<span class='btn btn-success'>Completed</span>";
        }else{
            $payment_details.="<span class='btn btn-danger'>Failed</span>";
        }
        
        $guest_details = "Name- <b>$name</b> <br> Mobile- <b>$mobile</b><br>Email- <b>$email</b>";
        $room_details = "";
        
        
        $sel_booking_details = mysqli_query($link,"SELECT * FROM `booking_details` where bookings_id='$id'");
        while($row_booking_details = mysqli_fetch_assoc($sel_booking_details)){
            $booking_room_id = $row_booking_details['room_id'];
            $booking_room_details = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `rooms` where id=$booking_room_id"));
            $room_name = $booking_room_details['name'];
            $room_category = $booking_room_details['room_category'];
            $room_category_details = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `room_category` where id=$room_category"));
            $room_category_name = $room_category_details['name'];
            
            $room_details.= "Room -<b> $room_category_name $room_name</b> <br>";
            
            $booking_room_name = $row_booking_details['name'];
            $booking_room_special_request = $row_booking_details['special_request'];
            $booking_room_adults = $row_booking_details['adults'];
            $booking_room_childs = $row_booking_details['childs'];
            $booking_room_childs_details = $row_booking_details['childs_details'];
            $booking_room_price = $row_booking_details['room_price'];
            $booking_room_extra_adult_price = $row_booking_details['extra_adult_price'];
            $booking_room_extra_child_price = $row_booking_details['extra_child_price'];
            $booking_room_total_price = $row_booking_details['total_price'];
            
            
            $room_details.= "Name- <b>$booking_room_name</b> <br> Special Request- <b>$booking_room_special_request</b> <br> Adults- <b>$booking_room_adults</b> <br> Childrens- <b>$booking_room_childs</b> <br> Childrens Age- <b>$booking_room_childs_details</b> <br> Room Price- <b>$booking_room_price</b> <br>Extra Adult charge- <b>$booking_room_extra_adult_price</b> <br> Extra Child Charge - <b>$booking_room_extra_child_price</b> <br> Total- <b>$booking_room_total_price</b> <hr>";
        }
        
        
        echo "<h3>Payment details</h3>";
    	echo "<p>$payment_details</p>";
    	 
        echo "<h3>Guest details</h3>";
    	echo "<p>$guest_details</p>";
    	
    	echo "<h3>Room details</h3>";
    	echo "<p>$room_details</p>";
    	
    	
    	           
        
    }
?>