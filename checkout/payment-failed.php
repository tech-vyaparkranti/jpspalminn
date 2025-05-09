<?php
    session_start();
    $booking_id = $_SESSION['booking_id'];
    echo "<h1>Your Payment has been failed for $booking_id</h1>";
    $_SESSION['booking_id'] = "";
    echo "<script>alert('payment failed');window.location.href='../index.php';</script>";
?>