<?php
    if($_SESSION["username"] != $username)
    {
        header("location: ?username=".$_SESSION["username"]);
        exit;
    }
?>