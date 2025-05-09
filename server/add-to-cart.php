<?php
    session_start();
    $session_id = session_id();
    include("../admin/database/database.php");
    
    header('Content-Type: application/json');
    
    date_default_timezone_set('Asia/Kolkata');
    $dat_asia = date('Y-m-d');
    $tym_asia = date('Y-m-d H:i:s');
    
    $room_id = $_GET['room_id'];
    $add_room = $_GET['add_room'];
    $checkin = $_GET['checkin'];
    $checkout = $_GET['checkout'];
    
    $response = ['success' => false, 'message' => ''];
    
    $isValidCheckin = DateTime::createFromFormat('Y-m-d', $checkin) !== false;
    $isValidCheckout = DateTime::createFromFormat('Y-m-d', $checkout) !== false;
    
    if (!$room_id || !$add_room) {
        $response['message'] = "Invalid selection.";
    } elseif (!$isValidCheckin || !$isValidCheckout) {
        $response['message'] = "Invalid date format. Please use YYYY-MM-DD.";
    } else {
        $checkinDate = new DateTime($checkin);
        $checkoutDate = new DateTime($checkout);
    
        if ($checkinDate < $checkoutDate) {
            $interval = $checkinDate->diff($checkoutDate);
            $nights = $interval->days;
    
            $sel_room = mysqli_query($link, "SELECT * FROM `rooms` WHERE status=1 AND id=$room_id");
            if ($room_details = mysqli_fetch_assoc($sel_room)) {
                $room_total_rooms = $room_details['total_rooms'];
                $room_base_adult = $room_details['base_adult'];
                $room_base_child = $room_details['base_child'];
                $room_base_price = $room_details['base_price'];
    
                $previous_bookings = 0 + mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) AS total_booked FROM `booking_details` WHERE room_id=$room_id AND payment_status=1"))['total_booked'];
                $available_rooms = $room_total_rooms - $previous_bookings;
    
                if ($add_room <= $available_rooms) {
                    mysqli_query($link,"DELETE FROM `cart` WHERE room_id=$room_id and session_id='$session_id'");
                    for ($i = 0; $i < $add_room; $i++) {
                        $room_total_price = $room_base_price * $nights;
                        $query = "INSERT INTO `cart`(`session_id`, `room_id`, `adults`, `childs`, `checkin`, `checkout`, `room_price`, `nights`, `total_price`, `created_at`, `updated_at`) VALUES ('$session_id', '$room_id', '$room_base_adult', '$room_base_child', '$checkin', '$checkout', '$room_base_price', '$nights', '$room_total_price', '$tym_asia', '$tym_asia')";
                        mysqli_query($link, $query);
                    }
                    $response['success'] = true;
                    $response['message'] = "Room added to cart. Number of nights: " . $nights;
                } else {
                    $response['message'] = "Not enough rooms available.";
                }
            } else {
                $response['message'] = "Room not found.";
            }
        } else {
            $response['message'] = "Check-out date must be after the check-in date.";
        }
    }
    
    echo json_encode($response);
?>
