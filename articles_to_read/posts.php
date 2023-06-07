<?php
include("../inc/conn.php");
$id = $_GET['id'];
$sql = $sql = " SELECT title , body , image  FROM articles WHERE id= $id";
$q = $conn->prepare($sql);
$q->execute();
$datas = $q->fetchAll();
foreach ($datas as $data) 
{
    $image = $data['image'] ;
    echo $data['body'];

    echo "<img src='../uploads/$image' >";
}
