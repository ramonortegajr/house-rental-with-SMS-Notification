<?php
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    header("Location:login_tenant.php");
?>