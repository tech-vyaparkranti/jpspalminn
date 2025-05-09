<?php
    include("mail.php");
    
    
    $msg = "<b>This is bold message</b>";
    
    if(send_mail("gagandureja675@gmail.com","test subject",$msg, $mail)){
        echo "Mail Sent";
    }else{
        echo "Failed to send mail";
    }
?>