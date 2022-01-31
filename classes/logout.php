<?php 
    session_start();
    if(isset($_SESSION['ultimate_userid']))
    {
        $_SESSION['ultimate_userid'] = NULL;
        unset($_SESSION['ultimate_userid']);
    }

    header('location: ../index_login.php');
    die();
?>