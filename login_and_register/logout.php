<?php
    session_start();

    if(session_destroy())
    {   
        setcookie('password_set', null, -1);
        setcookie('remember_set', null, -1);
        header("location: login.php");
    }
?>