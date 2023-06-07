<?php
session_start();
if(!isset($_SESSION['user'])) 
{
    header("location:../index.php");
    exit;
}
else {
    unset($_SESSION['user']);
    header("location:login.php");
    exit;
    
}
