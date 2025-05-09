<?php
    session_start();
    include("database/database.php");
    
    if(isset($_SESSION['a_icon'])){
        /*sweetalert session*/
        $a_title = $_SESSION['a_title'];
        $a_text = $_SESSION['a_text'];
        $a_icon = $_SESSION['a_icon'];
        $a_button = $_SESSION['a_button'];
    }
    
    
    extract($_POST);
    if(isset($sub)){	
    	$sel=mysqli_query($link,"select * from admin where email='$em'");
    	$arr=mysqli_fetch_assoc($sel);
    	if($em==$arr['email'] && $pass==$arr['password']){
    		$_SESSION['a_email'] = $em;
    		$admin_id = $arr['id'];
    		$admin_name = $arr['name'];
    		$_SESSION['a_id']=$admin_id;
    		$_SESSION['a_name']= $admin_name;
    		header("location:dashboard.php");
    	}else{
    		$_SESSION['a_title'] = "Error";
            $_SESSION['a_text'] = "Credentials don't match!!!";
            $_SESSION['a_icon'] = "error";
            $_SESSION['a_button'] = "Ok";
            echo "<script>window.location.href='index.php';</script>";
    	}
    }
    $panel_name = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `admin` where id=1"))['panel_name'];
?>

<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title><?=$panel_name?> | Panel</title>
    <!-- Favicon-->
    <link rel="icon" href="../assets/img/faviconn.jpg" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/authentication.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
</head>

<body class="theme-orange">
<div class="authentication">
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header slideDown" style="background: linear-gradient(45deg, #ffffff, #ffffff);">
                        <div class="logo"><img src="../img/logo.png" width="200" alt="<?=$panel_name?>"></div>
                        <!--<h1><?=$panel_name?></h1>-->
                    </div>                        
                </div>
                <form class="col-lg-12" id="sign_in" method="POST">
                    <h5 class="title">Sign in to your Account</h5>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" name="em" class="form-control">
                            <label class="form-label">Email</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" name="pass" class="form-control">
                            <label class="form-label">Password</label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <input type="submit" name="sub" class="btn btn-raised btn-primary waves-effect">
                </div>
                </form>
                
                <div class="col-lg-12 m-t-20">
                    <a class="" href="forgot-password.php">Forgot Password?</a>
                </div>                    
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/bundles/mainscripts.bundle.js"></script>

<!--sweetalert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
<?php
    if($a_icon){
?>
    swal({
        title: "<?=$a_title?>",
        text: "<?=$a_text?>",
        icon: "<?=$a_icon?>",
        button: "<?=$a_button?>"
    });
<?php
    unset($_SESSION['a_title']);
    unset($_SESSION['a_text']);
    unset($_SESSION['a_icon']);
    unset($_SESSION['a_button']);
}
?>
</script>

</body>
</html>