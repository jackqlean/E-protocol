<?php
require_once "config/init.php";
require "config/functions.php"; 

if (!isLoggedIn())
{
    header('Location: frm/form-login.php');
}
?>