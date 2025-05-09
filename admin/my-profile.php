<?php 
    include('header.php');
?>

<?php

    extract($_POST);
    if(isset($Usub)){
        $query = "UPDATE `admin` SET  `name`='$Uname', mobile='$Umob',email='$Umail',password='$Upass',`panel_name`='$Upname',`webmail`='$Uwmail',`webpass`='$Uwpass', updated_at='$tym_asia' WHERE id=$admin_id";
        if(mysqli_query($link,$query)){
            $_SESSION['a_email'] = $Umail;
            $_SESSION['a_name'] = $Uname;
            
            $_SESSION['a_title']= "Success";
            $_SESSION['a_text']= "Profile Updated.";
            $_SESSION['a_icon']= "success";
            $_SESSION['a_button']= "Ok";
        }else{
            $_SESSION['a_title']= "Error";
            $_SESSION['a_text']= "Technical Error!!!";
            $_SESSION['a_icon']= "error";
            $_SESSION['a_button']= "Ok";
        }
        echo "<script>window.location.href='my-profile.php';</script>";
    }
?>


    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Manage Profile </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="zmdi zmdi-home"></i>Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix"  >
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="header">
                            <h2>Update Profile </h2>
                        </div>
                        <div class="body">
                            
                            <?php
                                $pre_data = mysqli_fetch_assoc(mysqli_query($link,"select * from admin where email='$admin_email' and id='$admin_id'"));
                                $mob = $pre_data['mobile'];
                                $password = $pre_data['password'];
                                $panel_name = $pre_data['panel_name'];
                                $wmail = $pre_data['webmail'];
                                $wpass = $pre_data['webpass'];
                            ?>
                            
                            <form id="form_validation"   enctype="multipart/form-data" method="POST">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <p> <b>Name</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" name="Uname" value="<?=$admin_name?>" placeholder="Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p> <b>Mobile</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" name="Umob" minlength="10" maxlength="10" onkeypress="return isNumber(event)" value="<?=$mob?>" placeholder="Mobile" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p> <b>Panel Name</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" name="Upname" value="<?=$panel_name?>" placeholder="Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p> <b>Panel Email</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="email" class="form-control date" name="Umail" value="<?=$admin_email?>" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p> <b>Panel Password</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" name="Upass" value="<?=$password?>" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p> <b>Webmail Email</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="email" class="form-control date" name="Uwmail" value="<?=$wmail?>" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <p> <b>Webmail Password</b> </p>
                                        <div class="input-group"> <span class="input-group-addon"> <i class="material-icons"> </i> </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" name="Uwpass" value="<?=$wpass?>" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect" name="Usub" type="submit">SUBMIT</button>
                                <button class="btn btn-raised btn-danger waves-effect"    type="button" onclick="window.location='dashboard.php'">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div> 
    </section> 
<?php
    include("footer.php");
?>
    