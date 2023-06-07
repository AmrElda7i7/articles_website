<?php
session_start();
if(!isset($_SESSION['admin'])) 
{
    header("location:../index.php");
    exit;
}
else {
    unset($_SESSION['admin']);
    header("location:../index.php");
    exit;
    
}
