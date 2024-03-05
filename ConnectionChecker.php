<?php
    if (!isset($_SESSION["login"]) || $_SESSION["login"] == false) 
    {
        session_unset();
        session_destroy();
        header("Location: ../Login/Login.php");
        exit();
    }
?>