<?php
session_start() ;
include("../inc/conn.php");


if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("location:../index.php");
    exit;
}

$errors = [];
$allowed_extensions = ["png", "jpeg", "jpg", "gif"];


if (isset($_POST['add_article'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $body = filter_var($_POST['body'], FILTER_SANITIZE_STRING);
    $category = $_POST['categories'];
    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];


    $try = explode(".", $image_name);
    $extension = strtolower(end($try));



    if (empty($title)) {
        $errors[] = "you must write title";
    }
    if (empty($body)) {
        $errors[] = "you must write body";
    }
    if (empty($image_name)) {
        $errors[] = "you must upload an image";
    } elseif (!in_array($extension, $allowed_extensions)) {
        $errors[] = "this extension is not allowed";
    } elseif ($image_size > 10485760) {
        $errors[] = "image must be less than 10mb";
    }
    // var_dump($errors);
    if (empty($errors)) {
        $image = rand(0, 10000000) . "_" . $image_name;
        move_uploaded_file($image_tmp_name, "../uploads//" . $image);
        $username = $_SESSION['user']['name'];
        $sql = "SELECT id FROM users WHERE name ='$username' ";
        $q = $conn->prepare($sql);
        $q->execute();
        $data = $q->fetch();
        $id = $data['id'];

       

        $sql = "INSERT INTO articles (title,body,date_time,image,uid)VALUES ('$title','$body',NOW(),'$image','$id')";
        $q = $conn->prepare($sql);
        $q->execute();

        $sql = "SELECT * FROM articles where title ='$title'";
        $q = $conn->prepare($sql);
        $q->execute();
        $d = $q->fetch();

        $article_id = $d['id'];
        
        $sql = "INSERT INTO categories (name,article_id)VALUES ('$category','$article_id')";
        $q = $conn->prepare($sql);
        $q->execute();


    }




}


?>



















<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="title">
    <input type="text" name="body" placeholder="body">
    <input type="file" name="image">
    <select name="categories">
        <option value="chemistry">chemistry</option>
        <option value="psychology">psychology</option>
        <option value="history">history</option>
        <input type="submit" value="add_article" name="add_article">
    </select>



</form>