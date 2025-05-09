<?php 
session_start();
// Include configuration file 
include('config.php');
include("../admin/database/database.php");


$booking_id = $_GET['booking_id'];
$_SESSION['booking_id'] = $booking_id;

$sel_booking = mysqli_query($link,"SELECT * FROM `bookings` where booking_id='$booking_id'");
if(mysqli_num_rows($sel_booking)){
    $booking_details = mysqli_fetch_assoc($sel_booking);
}else{
    echo "<script>window.location.href='../index.php';</script>";
}

$total_amount = $booking_details['total'];
// Include database connection file 
// include_once 'dbConnect.php';
?>

<form action="<?php echo PAYPAL_URL; ?>" method="post" id="paypal_form">
    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
	
    <!-- Important For PayPal Checkout -->
    <input type="hidden" name="item_name" id="item" value="<?=$booking_id?>" required><br><br>
    <input type="hidden" required="" name="amount" value="<?=$total_amount?>" id="amount">
    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
	
    <!-- Specify a Buy Now button. -->
    <input type="hidden" name="cmd" value="_xclick">
    <!-- Specify URLs -->
    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
	<br><br>
    <!-- Display the payment button. -->
    <input type="submit" id="submit_button" name="submit" border="0" value="Pay" style="display:none;">
</form>

<script>
    document.getElementById("submit_button").click();
</script>

