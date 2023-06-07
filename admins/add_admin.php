<?php
session_start();
if(isset($_SESSION['user'])) 
{
    header("location:../index.php");
    exit;
}
include("../inc/conn.php");
if (isset($_POST['submit'])) {
    $name = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $errors = [];
    $rexSafety = "/^[^<,\"@/{}()*$%?=>:|;#]*$/i";
    // username validation  
    if (empty($name)) {
        $errors['name'] = "you must write username";
    } elseif (strlen($name) > 20) {
        $errors['name'] = "name must be less than 20 characters";
    } elseif (preg_match("![0-9/.,;'\\\[\]]!", $name)) {
        $errors['name'] = "name must not contain numbers or weird stuff";
    }

    //email validation 


    // check if the email is duplicated 
    $sql = "SELECT email FROM users WHERE email= '$email'";
    $q = $conn->prepare($sql);
    $q->execute();
    $data = $q->fetch();


    if (empty($email)) {
        $errors['email'] = "you must write email";
    } elseif (strlen($email) > 30) {
        $errors['email'] = "email must be less than 30 characters";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors['email'] = "invalid email";
    }elseif ($data) {
        $errors['email'] = "email is duplicated";
    }


    //password validation 
    if (empty($password)) {
        $errors['password'] = "you must write password";
    } elseif (strlen($password) > 30) {
        $errors['password'] = "password must be less than 30 characters";
    }
     elseif (strlen($password) < 6) {
        $errors['password'] = "password must be more than 6 characters";
    } 
    if(!$errors) {
        $password_hash = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO admins (name,email,password) VALUES ('$name','$email','$password_hash') ";
        $q= $conn->prepare($sql) ;
        $q->execute();
        $_POST['username'] = "";
        $_POST['email'] = "";
        $_POST['password'] = "";
       
        header("location:../index.php");
        exit();


    }










}?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<div class="body">
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" method="POST">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="username" placeholder="username" name="username" value="<?php
                        if (isset($_POST['username'])) {
                            echo $name;
                        }

                        ?>"> <br> 
                       <div class="error"><?php if (isset($errors['name'])) {
                       echo $errors['name'];}  ?></div> 
                    </div>

                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="email" placeholder="Email" name="email" value="<?php
                        if (isset($_POST['email'])) {
                            echo $email;
                        }

                        ?>">
                        <br> 
                       <div class="error"><?php if (isset($errors['email'])) {
                       echo $errors['email'];}  ?></div> 
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="password" placeholder="Password" name="password" value="<?php
                        if (isset($_POST['password'])) {
                            echo $password;
                        }

                        ?>">
                          <br> 
                       <div class="error"><?php if (isset($errors['password'])) {
                       echo $errors['password'];}  ?></div> 
                    </div>
                    <input type="submit" name="submit" class="signup" value="add admin">
                </form>
            </div>

            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</div>