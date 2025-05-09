<?php
    include("header.php");
?>

<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Welcome to JPS</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i> JPS</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix social-widget">
            
            
            <?php
                $total_category = mysqli_num_rows(mysqli_query($link,"SELECT * FROM `room_category`"));
            ?>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect facebook-widget">
                    <div class="icon"><i class="zmdi zmdi-format-align-left"></i></div>
                    <div class="content">
                        <div class="text"><a href="manage_room_category.php">Room Category</a></div>
                        <div class="number"><?=$total_category?></div>
                    </div>
                </div>
            </div>
            
            <?php
                $total_rooms = mysqli_num_rows(mysqli_query($link,"SELECT * FROM `rooms`"));
            ?>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect facebook-widget">
                    <div class="icon"><i class="zmdi zmdi-airline-seat-individual-suite"></i></div>
                    <div class="content">
                        <div class="text"><a href="manage_rooms.php">Rooms</a></div>
                        <div class="number"><?=$total_rooms?></div>
                    </div>
                </div>
            </div>
            
            <?php
                $total_bookings = mysqli_num_rows(mysqli_query($link,"SELECT * FROM `bookings`"));
            ?>
            <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                <div class="card info-box-2 hover-zoom-effect facebook-widget">
                    <div class="icon"><i class="zmdi zmdi-labels"></i></div>
                    <div class="content">
                        <div class="text"><a href="manage_bookings.php">Bookings</a></div>
                        <div class="number"><?=$total_bookings?></div>
                    </div>
                </div>
            </div>
            
             
            
            
            
            
            
             
        </div>
         
    </div>
</section>

<?php
    include("footer.php");
?>