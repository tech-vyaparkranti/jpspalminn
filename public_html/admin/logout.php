<?php
    session_start();
    $_SESSION['a_email'] = "";
    $_SESSION['a_id']= "";
    $_SESSION['a_name']=  "";
    header("location:index.php");
?>