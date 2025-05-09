<?php
    session_start();
    $session_id = session_id();
    include("../admin/database/database.php");
    
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
    // echo $checkin;
    // echo $checkout;
?>
    <div class="row">
        <div class="col-lg-12">
            <?php
                $all_cat = mysqli_query($link,"SELECT * FROM `room_category` where status=1");
                while($row_cat = mysqli_fetch_assoc($all_cat)){
                    $cat_id = $row_cat['id'];
                    $cat_name = $row_cat['name'];
                    $cat_adults = $row_cat['adults'];
                    $cat_childrens = $row_cat['childrens'];
                    $cat_photos = $row_cat['photos'];
                    
                    
                    // echo "<h2>$cat_name</h2>";
                    
                    $sel_rooms = mysqli_query($link,"SELECT * FROM `rooms` where status=1 and room_category=$cat_id");
                    while($row_room = mysqli_fetch_assoc($sel_rooms)){
                        $room_id = $row_room['id'];
                        $room_name = $row_room['name'];
                        $room_base_adult = $row_room['base_adult'];
                        $room_base_child = $row_room['base_child'];
                        $room_base_price = $row_room['base_price'];
                        $room_total_rooms = $row_room['total_rooms'];
                        
                        
                        
                        $checkinDate = new DateTime($checkin);
                        $checkoutDate = new DateTime($checkout);
                        $interval = $checkinDate->diff($checkoutDate);
                        $nights = $interval->days;
                        
                        $total_price_simple = $room_base_price * $nights;
                        
                        
                        
                        $previous_bookings = 0 + mysqli_fetch_assoc(mysqli_query($link,"SELECT count(*) AS total_booked FROM `booking_details` where room_id=$room_id and payment_status=1 AND ((checkin <= '$checkout' AND checkout >= '$checkin'))"))['total_booked'];
                        
                        $available_rooms = $room_total_rooms - $previous_bookings;
                        
                        $select_already_in_cart = mysqli_query($link,"SELECT * FROM `cart` where session_id='$session_id' and room_id=$room_id");
                        $total_already_in_cart = mysqli_num_rows($select_already_in_cart);
                        
                        ?>
                        <div class="col-md-4">
                            <img src="admin/uploaded_data/rooms/<?=$cat_photos?>" alt="<?php echo "$cat_name $room_name";?>">
                        </div>
                        <div class="col-md-8">
                            <div class="divider-l"></div>
                            <h4><?php echo "$cat_name $room_name";?></h4>
                            <div class="divider-l"></div>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Room Capacity: <?=$cat_adults?> <i class="ion-ios-person"></i> <?=$cat_childrens?> <i class="ion-ios-person"></i></p>
                                    <p>Room Rates Inclusive of Tax</p>
                                </div>
                                <div class="col-md-4">
                                    
                                    <?php
                                        // if($total_already_in_cart){
                                    ?>
                                           <!-- <p>Rs 4,590.88 <i class="fa fa-info-circle"></i></p>
                                            <span class="pere">Price for 1 Night</span><br>
                                            <span class="pere">2 Adults, 0 Child, 1 Room</span>-->
                                    <?php
                                        // }else{
                                    ?>
                                            <p>Rs <?=$total_price_simple?> <i class="fa fa-info-circle"></i></p>
                                            <span class="pere">Price for <?=$nights?> Night</span><br>
                                            <span class="pere"><?=$room_base_adult?> Adults, <?=$room_base_child?> Child, 1 Room</span>
                                    <?php
                                        // }
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6"> </div>
                                <div class="col-md-6">
                                    <ul class="roomr">
                                        <li><span><?=$available_rooms?> Rooms Left</span></li>
                                        <?php
                                            if($total_already_in_cart && $total_already_in_cart<=$available_rooms){
                                                echo "<div class='add_room' data-room-id=$room_id><input type='number' min=1 max='$available_rooms' onchange='add_to_cart($room_id,this.value)' value='$total_already_in_cart'></div>";
                                            }elseif($available_rooms){
                                                echo "<li class='enf'><a href='javascript:void(0)' class='btn' onclick='add_to_cart($room_id,1)'>Add Room</a></li>";
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                        
                        // echo "<h4> $cat_name $room_name</h4>";
                        // echo "<p>Room Capacity  $cat_adults <i class='ion-ios-person'></i> $cat_childrens<i class='ion-ios-person'></i></p>";
                        
                        // echo "$available_rooms available";
                        
                        
                        
                        
                        // create form on all rooms
                        // add room create new
                        // cart check if already then show input number with max onclick delete or add room
                        // list cart room forms adults and child
                        
                        
                        /*if($total_already_in_cart && $total_already_in_cart<=$available_rooms){
                            echo "<div class='add_room' data-room-id=$room_id><input type='number' min=1 max='$available_rooms' onchange='add_to_cart($room_id,this.value)' value='$total_already_in_cart'></div>";
                        }elseif($available_rooms){
                            echo "<div class='add_room'><button type='button' onclick='add_to_cart($room_id,1)'>Add Room</button></div>";
                        }*/
                        
                        
                        if($total_already_in_cart){
                            while($row_cart = mysqli_fetch_assoc($select_already_in_cart)){
                                
                                $count_room = 1;
                                $cart_id = $row_cart['id'];
                                $selected_adults = $row_cart['adults'];
                                $selected_childs = $row_cart['childs'];
                                $selected_childs_details = $row_cart['childs_details'];
                                if($selected_childs_details){
                                    $selected_childs_age = explode(",",$selected_childs_details);
                                }else{
                                    $selected_childs_age = array(50,50,50);
                                }
                                
                                
                                
                                
                                echo "<div id='cart_form_$cart_id'>";
                                
                                echo "<label>Adult:</label>";
                                echo "<select name='cart_adults' onchange='update_cart($cart_id)'>";
                                for ($i = 1; $i <= $cat_adults; $i++) {
                                    if($i==$selected_adults){
                                        echo "<option selected>$i</option>";
                                    }else{
                                        echo "<option>$i</option>";
                                    }
                                }
                                echo "</select>";
                                
                                
                                echo "<label>Child:</label>";
                                echo "<select name='cart_childs' onchange='update_cart($cart_id)'>";
                                for ($i = 0; $i <= $cat_childrens; $i++) {
                                    if($i==$selected_childs){
                                        echo "<option selected>$i</option>";
                                    }else{
                                        echo "<option>$i</option>";
                                    }
                                }
                                echo "</select>";
                                
                                if($selected_childs){
                                    for ($i = 1; $i <= $selected_childs; $i++) {
                                        echo "<label>Child $i:</label>";
                                        echo "<select name='child_age_$i' onchange='update_cart($cart_id)'>";
                                        echo "<option value=0 selected disabled>Age</option>";
                                        for ($j = 0; $j <= 12; $j++) {
                                            if($j==$selected_childs_age[$i-1]){
                                                echo "<option selected>$j</option>";
                                            }else{
                                                echo "<option>$j</option>";
                                            }
                                        }
                                        echo "</select>";
                                    }
                                }
                                echo "</div>";
                                $count_room++;
                            }
                        }
                        echo "<hr>";
                    }
                    ?>
                    <?php
                }
            ?>
        </div>
    </div>