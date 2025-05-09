<?php 
    include("header.php");
?>
<?php
if(isset($_GET['limit'])){
    $limit =$_GET['limit'];
    $Upayment_status =$_GET['payment_status'];
    $d1 =$_GET['d1'];
    $d2 =$_GET['d2'];
}else{
    $limit =100;
    $Upayment_status ="1";
    $d1 =$dat_asia;
    $d2 =$dat_asia;
}
?>

<?php
    extract($_POST);
?>
<style>
    .aa{
        font-size:30px;
    }
</style>
 
<section class="content">
   <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>All Bookings</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right"> 
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active">All Bookings</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid"> 
                    
        <div class="row clearfix"  >
                <div class="col-md-4"></div>
                <div class="col-md-4" style="padding:1%;">
                    <div class="card">
                        <div class="header">
                            <h2>  Filter Bookings </h2>
                            
                        </div>
                        <div class="body">
                            <form method="get" enctype="multipart/form-data">
                                <!-- Form Group Start -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-line">
                                            <input type="number" name="limit" min=1 value="<?=$limit?>" placeholder="Limit Results"   class="form-control" required>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-line"> 
                                            <select name="payment_status" class="form-control" required>
                                                <option value="0" <?php if($Upayment_status=="0"){echo "selected";} ?>>Failed</option>
                                                <option value="1" <?php if($Upayment_status=="1"){echo "selected";} ?>>Completed</option>
                                            </select>
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-line">
                                            <input type="date" name="d1" min=1 value="<?=$d1?>"    class="form-control" required>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-line"> 
                                            <input type="date" name="d2" min=1 value="<?=$d2?>"    class="form-control" required>
                                        </div> 
                                    </div>
                                </div>
                                <!-- Form Group Start -->
                                <div class="form-group row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <input type="submit" value="Filter" class="btn btn-sm btn-rounded btn-success">
                                        <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary" onClick="window.location.href='manage_bookings.php'">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <form method="post">
                <div class="card product_item_list">
                    <div class="body table-responsive">
                        <table class="table table-hover table table-bordered table-striped table-hover js-exportable dataTable   m-b-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Booking ID.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Booked on</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                    $query = "SELECT * FROM bookings where payment_status=$Upayment_status and (checkin>='$d1' and checkin<='$d2') order by id desc limit $limit";
                                    // echo $query;
                                    $sql=mysqli_query($link,$query);
                                    $i=1;
                                    if(mysqli_num_rows($sql)>0){
                                        while($row=mysqli_fetch_assoc($sql)){
                                            $id = $row['id'];
                                            $booking_id = $row['booking_id'];
                                            $name = $row['name'];
                                            $mobile = $row['mobile'];
                                            $email = $row['email'];
                                            $total = $row['total'];
                                            $pay_mode = $row['pay_mode'];
                                            $payment_id = $row['payment_id'];
                                            $booked_on = $row['booked_on'];
                                            $checkin = $row['checkin'];
                                            $checkout = $row['checkout'];
                                            $nights = $row['nights'];
                                            $payment_status = $row['payment_status'];
                                            
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
 
                                            echo "<tr>";
                                                echo "<td> $i  </td>";
                                                echo "<td><a href='javascript:void(0);' onclick='view_booking_details($id);'> $booking_id </a></td>";
                                                echo "<td> $name </td>";
                                                echo "<td> $mobile </td>";
                                                echo "<td> $email </td>";
                                                echo "<td> $payment_details </td>";
                                                echo "<td> $checkin_details </td>";
                                                echo "<td><span style='display:none;'>$dat_sort</span> $dat_view </td>";
                                            echo "</tr>";
                                            $i++;
                                    }
                                } 
                                ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>   
<?php
    include("footer.php");
?>


<div class="modal" id="details_modal">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" onclick="print_details()">Print</button>
                <div class="sign-up-form m-2" id="booking_details">
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function view_booking_details(id){
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $('#booking_details').html(this.responseText);
                $('#details_modal').modal('show');
            }
        };
        xhttp.open("GET", "booking_details.php?id="+id, true);
        xhttp.send();
    }
</script>
    