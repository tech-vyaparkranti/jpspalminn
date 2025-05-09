<aside id="leftsidebar" class="sidebar"> 
    <!-- User Info -->
    <div class="user-info">
        <div class="image"> <img src="assets/images/avatar1.jpg" width="48" height="48" alt="User" /> </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"><?=$admin_name?></div>
            <div class="email" style="font-size:10px;"><?=$admin_email?></div>
            <div class="btn-group user-helper-dropdown"> <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button"> keyboard_arrow_down </i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="my-profile.php"><i class="material-icons">person</i>Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info --> 
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="dashboard.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span> </a></li>
            <li><a href="manage_room_category.php"><i class="zmdi zmdi-format-align-left"></i><span>Room Category</span> </a></li>
            <li><a href="manage_rooms.php"><i class="zmdi zmdi-airline-seat-individual-suite"></i><span>Rooms</span> </a></li>
            <li><a href="manage_bookings.php"><i class="zmdi zmdi-labels"></i><span>Bookings</span> </a></li>
            <!--<li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-menu"></i><span>Main Menu</span></a>
                <ul class="ml-menu">
                    <li><a href="manage_category.php">Category</a></li>
                    <li><a href="manage_subcategory.php">Sub Category</a></li>
                    <li><a href="manage_subcat_images.php">Sub Category Images</a></li>
                    <li><a href="manage_subcat_design.php">Sub Category Design</a></li>
                </ul>
            </li>-->
            <li><a href="logout.php"><i class="zmdi zmdi-sign-in"></i><span>Sign Out</span> </a></li>
        </ul>
    </div>
    <!-- #Menu --> 
</aside>