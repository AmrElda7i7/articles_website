<?php 
session_start() ;
if(!isset($_SESSION['admin'])) 
{
    header("location:../index.php");
    exit;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admins</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div><a href="users.php">users</a></div>
    <div><a href="add_admin.php">add admins</a></div>
    <div><a href="articles.php">articles</a></div>
    <div><a href="logout_admins.php">logout</a></div>
    <div><a href="list_of_admins.php">admins</a></div>
</body>
</html>