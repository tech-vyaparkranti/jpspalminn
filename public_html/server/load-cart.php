<?php
    session_start();
    $session_id = session_id();
    include("../admin/database/database.php");
    date_default_timezone_set('Asia/Kolkata');
    $dat_asia = date('Y-m-d');
    $tym_asia = date('Y-m-d H:i:s');
    
    $dat_asia_plus_one = date('Y-m-d', strtotime($dat_asia . ' +1 day'));
    
    
    $total_price = 0;
    
    $select_cart = mysqli_query($link,"SELECT *,COUNT(*) as number_of_rooms, SUM(adults) as adults, SUM(childs) as childs, SUM(total_price) as total_price  FROM `cart` where session_id='$session_id' group by room_id");
    
    ?>
    <div class="card-title">
        <h4>Booking Summary</h4>
    </div> <div class="divider-l"></div>
    <div class="card-body">
    <?php
        if(mysqli_num_rows($select_cart)){
            
            $select_1 = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `cart` where session_id='$session_id' order by id desc limit 1"));
            $checkin = $select_1['checkin'];
            $checkout = $select_1['checkout'];
            $nights = $select_1['nights'];
            
            $checkin = date("d M Y", strtotime($checkin));
            $checkout = date("d M Y", strtotime($checkout));
            ?>
                <p class="pereq"><b>Dates:</b> <?=$checkin?> - <?=$checkout?></p>
                <p class="pereq"><b>Night:</b> <?=$nights?></p><hr>
               <!--<div class="divider-l"></div>-->
            <?php
            // echo "<p>Dates  $checkin - $checkout</p>";
            // echo "<p>Night   $nights</p>";
            while($row_cart = mysqli_fetch_assoc($select_cart)){
                $booking_room_id = $row_cart['room_id'];
                $booking_room_details = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `rooms` where id=$booking_room_id"));
                $room_name = $booking_room_details['name'];
                $room_category = $booking_room_details['room_category'];
                $room_category_details = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `room_category` where id=$room_category"));
                $room_category_name = $room_category_details['name'];
                $room_details = " <b> $room_category_name $room_name</b>";
                
                // select cart room again one by one for adults and price total
                
                $booking_room_adults = $row_cart['adults'];
                $booking_room_childs = $row_cart['childs'];
                $booking_room_price = $row_cart['room_price'];
                $booking_room_extra_adult_price = $row_cart['extra_adult_price'];
                $booking_room_extra_child_price = $row_cart['extra_child_price'];
                $booking_room_total_price = $row_cart['total_price'];
                $number_of_rooms = $row_cart['number_of_rooms'];
                if($number_of_rooms>1){
                    $number_of_rooms = $number_of_rooms." Rooms";
                }else{
                    $number_of_rooms = $number_of_rooms." Room";
                }
                
                echo "<div class='card'>";
                echo "<div style='display:flex;'><h4>$room_details</h4>";
                echo "<button type='button' onclick='remove_room($booking_room_id)'>X</button></div>";
                echo "<span class='pere'>Adults- $booking_room_adults, Childs-$booking_room_childs </span>";
                echo "<br><span class='pere'> $number_of_rooms</span>";
                echo "<p> Rs $booking_room_total_price</p>";
                echo "</div>";
                
                $total_price+=$booking_room_total_price;
            }
            echo "<p>Total   $total_price</p>";
            echo '<a href="confirm-booking.php" class="btn">Book</a>';
            // echo '<button type="button" onclick="window.location.href=\'confirm-booking.php\'">Book Now</button>';
        }else{
            echo "No room selected.";
        }
    ?>
    </div>