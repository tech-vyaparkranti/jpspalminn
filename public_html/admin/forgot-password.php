<?php
session_start();
include("database/database.php");
include("mail/mail.php");

/*sweetalert session*/
$a_title = $_SESSION['a_title'];
$a_text = $_SESSION['a_text'];
$a_icon = $_SESSION['a_icon'];
$a_button = $_SESSION['a_button'];
$panel_name = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `admin` where id=1"))['panel_name'];
?>


<?php

extract($_POST);
if(isset($Usub)){
    $sel_admin = mysqli_query($link,"SELECT * FROM `admin` WHERE `email`='$Umail'");
    if(mysqli_num_rows($sel_admin)){
        $admin_pass = mysqli_fetch_assoc($sel_admin)['password'];

		$to   	 = $Umail;
		$subject = "Forgot Password";
		$message = "<html><body>";
		$message.= "<hr>Hii,<br/><br/>";
		$message.="As on your request we have shared your password. Please ignore if not requested.<br/><br/>";
		$message.="Email : $Umail<br/>";
		$message.="Pqassword  : <b>$admin_pass</b><br/>";
		$message.="Warm regards,<br/>";
		$message.="<b>$panel_name</b><br/>";
		$message.="<p>PLEASE DO NOT REPLY TO THIS MAIL.";
		$message.="THIS IS AN AUTO GENERATED MAIL ";
		$message.= "</body></html>";
		
		
		if(send_mail($to,$subject,$message, $mail)){
		    $_SESSION['a_title'] = "Success";
            $_SESSION['a_text'] = "Password shared on Email ($to).";
            $_SESSION['a_icon'] = "success";
            $_SESSION['a_button'] = "Ok";
		}else{
		    $_SESSION['a_title'] = "Error";
            $_SESSION['a_text'] = "Technical Error in sending mail!!!";
            $_SESSION['a_icon'] = "error";
            $_SESSION['a_button'] = "Ok";
		}
    }else{
        $_SESSION['a_title'] = "Error";
        $_SESSION['a_text'] = "Email not found!!!";
        $_SESSION['a_icon'] = "error";
        $_SESSION['a_button'] = "Ok";
    }
    echo "<script>window.location.href='forgot-password.php';</script>";
}

?>



<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title><?=$panel_name?> | Forgot Password</title>
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
                    <div class="header slideDown"  style="background: linear-gradient(45deg, #ffffff, #ffffff);">
                        <div class="logo"><img src="../img/logo.png" width="200" alt="<?=$panel_name?>"></div>
                        <!--<h1> <?=$panel_name?> </h1>-->
                    </div>                        
                </div>
                <form class="col-lg-12" id="sign_in" method="POST">
                    <h5 class="title">Forgot Password</h5>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="Umail" id="usr" required>
                            <label class="form-label">Email</label>
                        </div>
                    </div>

                    <div class="col-lg-12">
                    <input type="submit" value="Submit" name="Usub" class="btn btn-raised btn-primary waves-effect"/>                    
                </div>                      
                </form>
               
                <div class="col-lg-12 m-t-20">
                    <a class="" href="index.php">Back to login</a>
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
<?
    if($a_icon){
?>
    swal({
        title: "<?=$a_title?>",
        text: "<?=$a_text?>",
        icon: "<?=$a_icon?>",
        button: "<?=$a_button?>"
    });
<?
    unset($_SESSION['a_title']);
    unset($_SESSION['a_text']);
    unset($_SESSION['a_icon']);
    unset($_SESSION['a_button']);
}
?>
</script>

</body>
</html>