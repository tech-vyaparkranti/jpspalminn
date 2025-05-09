<?php 
    include('header.php');
?>

<?php

    $edit_id = $_GET['edid'];
    extract($_POST);
    
    /*room submit*/
    if(isset($Usub)){
        if($Ubreakfast==0){
            $Uextra_adult_breakfast_price = $Uextra_child_5_9_breakfast_price = $Uextra_child_10_breakfast_price = 0;
        }
        if($edit_id==''){
            $query = "INSERT INTO `rooms`(`room_category`, `name`, `base_adult`, `base_child`, `base_price`, `extra_adult_price`, `extra_child_5_9_price`, `extra_child_10_price`, `breakfast`, `extra_adult_breakfast_price`, `extra_child_5_9_breakfast_price`, `extra_child_10_breakfast_price`, `total_rooms`, `status`, `created_at`, `updated_at`) VALUES ('$Uroom_category','$Uname','$Ubase_adult','$Ubase_child','$Ubase_price','$Uextra_adult_price','$Uextra_child_5_9_price','$Uextra_child_10_price','$Ubreakfast','$Uextra_adult_breakfast_price','$Uextra_child_5_9_breakfast_price','$Uextra_child_10_breakfast_price','$Utotal_rooms','$Ustatus','$tym_asia','$tym_asia')";
        }else{
            $query = "UPDATE `rooms` SET `room_category`='$Uroom_category',`name`='$Uname',`base_adult`='$Ubase_adult',`base_child`='$Ubase_child',`base_price`='$Ubase_price',`extra_adult_price`='$Uextra_adult_price',`extra_child_5_9_price`='$Uextra_child_5_9_price',`extra_child_10_price`='$Uextra_child_10_price',`breakfast`='$Ubreakfast',`extra_adult_breakfast_price`='$Uextra_adult_breakfast_price',`extra_child_5_9_breakfast_price`='$Uextra_child_5_9_breakfast_price',`extra_child_10_breakfast_price`='$Uextra_child_10_breakfast_price',`total_rooms`='$Utotal_rooms',`status`='$Ustatus',`updated_at`='$tym_asia' ";
            $query.= " WHERE id=$edit_id";
        }
        if(mysqli_query($link,$query)){
            $_SESSION['a_title']= "Success";
            $_SESSION['a_text']= "Room Data Updated.";
            $_SESSION['a_icon']= "success";
            $_SESSION['a_button']= "Ok";
        }else{
            $_SESSION['a_title']= "Error";
            $_SESSION['a_text']= "Technical Error!!!";
            $_SESSION['a_icon']= "error";
            $_SESSION['a_button']= "Ok";
        }
        echo "<script>window.location.href='manage_rooms.php';</script>";
    }
    
    
    if($edit_id){
        $sel_data = mysqli_query($link,"SELECT * FROM `rooms` WHERE id=$edit_id");
        if(mysqli_num_rows($sel_data)){
            $previous_data = mysqli_fetch_assoc($sel_data);
        }else{
            $_SESSION['a_title']= "Error";
            $_SESSION['a_text']= "Invalid URL!!!";
            $_SESSION['a_icon']= "error";
            $_SESSION['a_button']= "Ok";
            echo "<script>window.location.href='manage_rooms.php';</script>";
        }
    }
    
    
?>


    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Manage Rooms </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Rooms</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix"  >
                <div class="col-md-12">
                    <form id="form_validation"  autocomplete="off" method="POST" enctype="multipart/form-data">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card p-4">
                            <div class="header">
                                <h2>Update Room Data</h2> 
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p> <b>Room Category </b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <select name="Uroom_category" class="form-control date" required>
                                                <option value="" selected disabled>Select Room Category</option>
                                                <?php
                                                    $all_cat = mysqli_query($link,"SELECT * FROM `room_category`");
                                                    while($row_cat = mysqli_fetch_assoc($all_cat)){
                                                        $cat_id = $row_cat['id'];
                                                        $cat_name = $row_cat['name'];
                                                ?>
                                                    <option value="<?=$cat_id?>" <?php if($previous_data['room_category']==$cat_id){ echo "selected";} ?> ><?=$cat_name?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Room Name</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" value="<?=$previous_data['name']?>" name="Uname" placeholder="Enter Room Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Adults</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 max=10 class="form-control date" value="<?=$previous_data['base_adult']?>" name="Ubase_adult" placeholder="Enter Adults" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Childrens</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 max=10 class="form-control date" value="<?=$previous_data['base_child']?>" name="Ubase_child" placeholder="Enter Childrens" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Base Price</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 class="form-control date" value="<?=$previous_data['base_price']?>" name="Ubase_price" placeholder="Enter Base Price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Extra adult price</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 class="form-control date" value="<?=$previous_data['extra_adult_price']?>" name="Uextra_adult_price" placeholder="Enter Extra adult price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Extra child (5-9) Price</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 class="form-control date" value="<?=$previous_data['extra_child_5_9_price']?>" name="Uextra_child_5_9_price" placeholder="Enter Extra child (5-9) Price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Extra child (9+) Price</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 class="form-control date" value="<?=$previous_data['extra_child_10_price']?>" name="Uextra_child_10_price" placeholder="Enter Extra child (9+) Price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Breakfast </b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <select name="Ubreakfast" onchange="show_breakfast(this.value)" class="form-control date" required>
                                                <option value="" selected disabled>Select breakfast included</option>
                                                    <option value="1" <?php if($previous_data['breakfast']==1){ echo "selected";} ?> >Yes</option>
                                                    <option value="0" <?php if($previous_data['breakfast']==0){ echo "selected";} ?> >No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-9 row" id="breakfast_price" <?php if($previous_data['breakfast']==0){echo "style='display:none;'";} ?>>
                                    <div class="col-md-4">
                                        <p> <b>Extra adult breakfast price</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="number" min=0 class="form-control date" value="<?=$previous_data['extra_adult_breakfast_price']?>" name="Uextra_adult_breakfast_price" placeholder="Enter Extra adult breakfast price" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <p> <b>Extra child (5-9) breakfast price</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="number" min=0 class="form-control date" value="<?=$previous_data['extra_child_5_9_breakfast_price']?>" name="Uextra_child_5_9_breakfast_price" placeholder="Enter Extra child (5-9) breakfast price">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <p> <b>Extra child (9+) breakfast price</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="number" min=0 class="form-control date" value="<?=$previous_data['extra_child_10_breakfast_price']?>" name="Uextra_child_10_breakfast_price" placeholder="Enter Extra child (9+) breakfast price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <p> <b>Total rooms</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 class="form-control date" value="<?=$previous_data['total_rooms']?>" name="Utotal_rooms" placeholder="Total rooms" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="switch">
                                        <br><br>
                                        <label>Hide
                                            <input type="checkbox" name="Ustatus" value="<?=$previous_data['status']?>" class="change_checkbox" <?php if($previous_data['status']){echo "checked";} ?>>
                                            <span class="lever"></span>Show
                                        </label>
                                    </div>
                                </div>
                                 
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-raised btn-primary waves-effect" name="Usub" type="submit">Save</button>
                                    <button class="btn btn-raised btn-danger waves-effect" type="button" onclick="window.location='manage_rooms.php'">Cancel</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                  
                    
              </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Rooms </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Base</th>
                                        <th>Extra Price</th>
                                        <th>Breakfast</th>
                                        <th>Extra Breakfast Price</th>
                                        <th>Rooms</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Base</th>
                                        <th>Extra Price</th>
                                        <th>Breakfast</th>
                                        <th>Extra Breakfast Price</th>
                                        <th>Rooms</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $cnt = 1;
                                        $all_rooms = mysqli_query($link,"SELECT * FROM `rooms`");
                                        while($row_room = mysqli_fetch_assoc($all_rooms)){
                                            $cat_id = $row_room['room_category'];
                                            $cat_name = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `room_category` where id=$cat_id"))['name'];
                                            $breakfast = $row_room['breakfast'];
                                            if($breakfast){
                                                $breakfast_text = "Yes";
                                                $extra_adult_breakfast_price = $row_room['extra_adult_breakfast_price'];
                                                $extra_child_5_9_breakfast_price = $row_room['extra_child_5_9_breakfast_price'];
                                                $extra_child_10_breakfast_price = $row_room['extra_child_10_breakfast_price'];
                                                $breakfast_details = "Adult- $extra_adult_breakfast_price <br> child(5-9)- $extra_child_5_9_breakfast_price <br> child(9+)- $extra_child_10_breakfast_price";
                                            }else{
                                                $breakfast_text = "No";
                                                $breakfast_details = "";
                                            }
                                            
                                            echo "<tr>";
                                            echo "<td>$cnt</td>";
                                            if($row_room['status']){
                                                echo '<td><span class="btn btn-success">Show</span></td>';
                                            }else{
                                                echo '<td><span class="btn btn-danger">Hide</span></td>';
                                            }
                                            echo "<td><a href='manage_rooms.php?edid=".$row_room['id']."'><i class='zmdi zmdi-edit'></i></a></td>";
                                            echo "<td>$cat_name</td>";
                                            echo "<td>".$row_room['name']."</td>";
                                            echo "<td> Adults-".$row_room['base_adult']."<br> childrens-".$row_room['base_child']."<br> Price-".$row_room['base_price']."</td>";
                                            echo "<td> Adult-".$row_room['extra_adult_price']."<br> child(5-9)-".$row_room['extra_child_5_9_price']."<br> child(9+)-".$row_room['extra_child_10_price']."</td>";
                                            echo "<td>$breakfast_text</td>";
                                            echo "<td>$breakfast_details</td>";
                                            echo "<td>".$row_room['total_rooms']."</td>";
                                            echo "</tr>";
                                            
                                            $cnt++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
<?php
    include("footer.php");
?>
<script>
    function show_breakfast(str){
        if(str==1){
            $('#breakfast_price').show();
        }else{
            $('#breakfast_price').hide();
        }
    }
</script>