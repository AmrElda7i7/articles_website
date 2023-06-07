<?php
session_start();
include("../inc/conn.php");
$id = $_GET['id'];
if(isset($_GET['id']) ) 
{
    $sql = "DELETE FROM users WHERE id = '$id'";
    $q = $conn->prepare($sql);
    $q->execute();
    
}
header("location:users.php");
exit; 