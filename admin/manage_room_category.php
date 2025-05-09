<?php 
    include('header.php');
?>

<?php

    $edit_id = $_GET['edid'];
    extract($_POST);
    
    /*category submit*/
    if(isset($Usub)){
        
        
        /*$allowTypes = array('jpg','png','jpeg','gif','webp');
        $insertValuesSQL = "";
        $fileNames = $_FILES['Uphotos']['name'];
        if(!empty($fileNames)){
            foreach($_FILES['Uphotos']['name'] as $key=>$val){ 
                $fileName = rand().basename($_FILES['Uphotos']['name'][$key]); 
                $targetFilePath = "uploaded_data/rooms/" . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                if(in_array($fileType, $allowTypes)){ 
                    if(move_uploaded_file($_FILES["Uphotos"]["tmp_name"][$key], $targetFilePath)){ 
                        $insertValuesSQL .= $fileName.","; 
                    } 
                } 
            }
            $insertValuesSQL = trim($insertValuesSQL, ','); 
        }*/
        
        $fn = $_FILES['Uphoto']['name'];
        if($fn){
            $fnn = rand().$fn;
            move_uploaded_file($_FILES['Uphoto']['tmp_name'],'uploaded_data/rooms/'.$fnn);
        }else{
            $fnn = "";
        }
        
        
        if($edit_id==''){
            $query = "INSERT INTO `room_category`(`name`, `adults`, `childrens`, `room_amenities_dryer`, `room_amenities_housekeep`, `room_amenities_tea`, `hotel_amenities_parking`, `hotel_amenities_wifi`, `hotel_amenities_drink`, `photos`, `status`, `created_at`, `updated_at`) VALUES ('$Uname','$Uadults','$Uchildrens','$Uroom_amenities_dryer','$Uroom_amenities_housekeep','$Uroom_amenities_tea','$Uhotel_amenities_parking','$Uhotel_amenities_wifi','$Uhotel_amenities_drink','$fnn','$Ustatus','$tym_asia','$tym_asia')";
        }else{
            $query = "UPDATE `room_category` SET `name`='$Uname',`adults`='$Uadults',`childrens`='$Uchildrens',`room_amenities_dryer`='$Uroom_amenities_dryer',`room_amenities_housekeep`='$Uroom_amenities_housekeep',`room_amenities_tea`='$Uroom_amenities_tea',`hotel_amenities_parking`='$Uhotel_amenities_parking',`hotel_amenities_wifi`='$Uhotel_amenities_wifi',`hotel_amenities_drink`='$Uhotel_amenities_drink',`status`='$Ustatus',`updated_at`='$tym_asia' ";
            if($fnn){
                $query.= " ,`photos`='$fnn'";
            }
            $query.= " WHERE id=$edit_id";
        }
        if(mysqli_query($link,$query)){
            $_SESSION['a_title']= "Success";
            $_SESSION['a_text']= "Category Data Updated.";
            $_SESSION['a_icon']= "success";
            $_SESSION['a_button']= "Ok";
        }else{
            $_SESSION['a_title']= "Error";
            $_SESSION['a_text']= "Technical Error!!!";
            $_SESSION['a_icon']= "error";
            $_SESSION['a_button']= "Ok";
        }
        echo "<script>window.location.href='manage_room_category.php';</script>";
    }
    
    
    if($edit_id){
        $sel_data = mysqli_query($link,"SELECT * FROM `room_category` WHERE id=$edit_id");
        if(mysqli_num_rows($sel_data)){
            $previous_data = mysqli_fetch_assoc($sel_data);
        }else{
            $_SESSION['a_title']= "Error";
            $_SESSION['a_text']= "Invalid URL!!!";
            $_SESSION['a_icon']= "error";
            $_SESSION['a_button']= "Ok";
            echo "<script>window.location.href='manage_room_category.php';</script>";
        }
    }
    
    
?>


    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Manage Room Category </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
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
                                <h2>Update Category Data</h2> 
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p> <b>Category Name</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control date" value="<?=$previous_data['name']?>" name="Uname" placeholder="Enter Category Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Adults</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 max=10 class="form-control date" value="<?=$previous_data['adults']?>" name="Uadults" placeholder="Enter Maximum Adults" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p> <b>Childrens</b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <input type="number" min=0 max=10 class="form-control date" value="<?=$previous_data['childrens']?>" name="Uchildrens" placeholder="Enter Maximum Childrens" required>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-3">
                                    <p> <b>Photo </b> </p>
                                    <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                        <div class="form-line">
                                            <!--<input type="file" accept="image/*" class="form-control date"  name="Uphotos[]" title="Select Photos" multiple>-->
                                            <input type="file" accept="image/png, image/gif, image/jpeg" class="form-control date"  name="Uphoto" title="Select Photo" <?php if($edit_id==""){echo "required";} ?>>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <input type="checkbox" id="dryer_checkbox" name="Uroom_amenities_dryer" value="<?=$previous_data['room_amenities_dryer']?>" class="filled-in change_checkbox" <?php if($previous_data['room_amenities_dryer']){echo "checked";} ?>>
                                    <label for="dryer_checkbox">Hair Dryer</label>
                                </div>
                                
                                <div class="col-md-3">
                                    <input type="checkbox" id="housekeep_checkbox" name="Uroom_amenities_housekeep" value="<?=$previous_data['room_amenities_housekeep']?>" class="filled-in change_checkbox" <?php if($previous_data['room_amenities_housekeep']){echo "checked";} ?>>
                                    <label for="housekeep_checkbox">Daily Housekeeping</label>
                                </div>
                                
                                <div class="col-md-3">
                                    <input type="checkbox" id="tea_checkbox" name="Uroom_amenities_tea" value="<?=$previous_data['room_amenities_tea']?>" class="filled-in change_checkbox" <?php if($previous_data['room_amenities_tea']){echo "checked";} ?>>
                                    <label for="tea_checkbox">Tea/Coffee maker</label>
                                </div>
                                
                                <div class="col-md-3">
                                    <input type="checkbox" id="parking_checkbox" name="Uhotel_amenities_parking" value="<?=$previous_data['hotel_amenities_parking']?>" class="filled-in change_checkbox" <?php if($previous_data['hotel_amenities_parking']){echo "checked";} ?>>
                                    <label for="parking_checkbox">Parking</label>
                                </div>
                                
                                <div class="col-md-3">
                                    <input type="checkbox" id="wifi_checkbox" name="Uhotel_amenities_wifi" value="<?=$previous_data['hotel_amenities_wifi']?>" class="filled-in change_checkbox" <?php if($previous_data['hotel_amenities_wifi']){echo "checked";} ?>>
                                    <label for="wifi_checkbox">Wifi</label>
                                </div>
                                
                                <div class="col-md-3">
                                    <input type="checkbox" id="drink_checkbox" name="Uhotel_amenities_drink" value="<?=$previous_data['hotel_amenities_drink']?>" class="filled-in change_checkbox" <?php if($previous_data['hotel_amenities_drink']){echo "checked";} ?>>
                                    <label for="drink_checkbox">Welcome Drink</label>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="switch">
                                        <label>Hide
                                            <input type="checkbox" name="Ustatus" value="<?=$previous_data['status']?>" class="change_checkbox" <?php if($previous_data['status']){echo "checked";} ?>>
                                            <span class="lever"></span>Show
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-raised btn-primary waves-effect" name="Usub" type="submit">Save</button>
                                    <button class="btn btn-raised btn-danger waves-effect" type="button" onclick="window.location='manage_room_category.php'">Cancel</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                  
                    
              </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>All Category </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                        $cnt = 1;
                                        $all_cat = mysqli_query($link,"SELECT * FROM `room_category`");
                                        while($row_cat = mysqli_fetch_assoc($all_cat)){
                                            echo "<tr>";
                                            echo "<td>$cnt</td>";
                                            if($row_cat['status']){
                                                echo '<td><span class="btn btn-success">Show</span></td>';
                                            }else{
                                                echo '<td><span class="btn btn-danger">Hide</span></td>';
                                            }
                                            echo "<td><a href='manage_room_category.php?edid=".$row_cat['id']."'><i class='zmdi zmdi-edit'></i></a></td>";
                                            echo "<td>".$row_cat['name']."</td>";
                                            echo "<td> Adults-".$row_cat['adults']."<br> childrens-".$row_cat['childrens']."</td>";
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