<?php
    session_start();
    $_SSESSION = array();
    if(isset($_COOKIE[session_name()]) == true)
    {
        setcookie(session_name(),'',time()-4200,'/');
    }
    session_destroy();
    header( "Location: ./staff_login.php" ) ;
?>