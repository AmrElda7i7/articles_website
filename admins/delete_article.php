<?php
include("../inc/conn.php");
$id = $_GET['id'];
$image = $_GET['image'];
if(isset($_GET['id']) ) 
{
    $sql = "DELETE FROM articles WHERE id = '$id'";
    $q = $conn->prepare($sql);
    $q->execute();
    
    unlink( "../uploads/$image");
}
header("location:articles.php");
exit; 