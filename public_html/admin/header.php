<?php
    session_start();
    if(isset($_SESSION['a_id'])){
        $admin_id = $_SESSION['a_id'];
        $admin_email = $_SESSION['a_email'];
        $admin_name = $_SESSION['a_name'];
    }
    
    include("database/database.php");
    $sel=mysqli_query($link,"select * from admin where email='$admin_email' and id='$admin_id'");
    $arr_count=mysqli_num_rows($sel);
    if($arr_count!=1){
        $_SESSION['a_title']= "Error";
        $_SESSION['a_text']= "Please login first!!!";
        $_SESSION['a_icon']= "error";
        $_SESSION['a_button']= "Ok";
        header("location:index.php");
    }
    
    date_default_timezone_set('Asia/Kolkata');
    $dat_asia = date('Y-m-d');
    $tym_asia = date('Y-m-d H:i:s');
    
    function current_url(){
        $url      = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $validURL = str_replace("&", "&amp;", $url);
        return $url;
    }
    $now_url = current_url();
    
    if(isset($_SESSION['a_icon'])){
        /*sweetalert session*/
        $a_title = $_SESSION['a_title'];
        $a_text = $_SESSION['a_text'];
        $a_icon = $_SESSION['a_icon'];
        $a_button = $_SESSION['a_button'];
    }
    
    $panel_name = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `admin` where id=1"))['panel_name'];
    
?>
<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?=$panel_name?> | Panel">
    <title><?=$panel_name?> | Panel</title>
    <link rel="icon" href="../assets/img/faviconn.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link  rel="stylesheet" href="assets/css/main.css">
    <link  rel="stylesheet" href="assets/css/animate_page.css">
    <link rel="stylesheet" href="assets/css/color_skins.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="theme-orange">
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="col-12">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="dashboard.php"><?=$panel_name?></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php" class="mega-menu xs-hide" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
            </ul>
        </div>
    </nav>

<!-- Left Sidebar -->
<?php
    include("sidebar.php");
?>

