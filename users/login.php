<?php
session_start();
if(isset($_SESSION['user'])) 
{
    header("location:../index.php");
    exit;
}
include("../inc/conn.php");
if (isset($_POST['submit'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

    $errors = [];

    //email validation 


    // check if the email is duplicated 
    $sql = "SELECT * FROM users WHERE email= '$email'";
    $q = $conn->prepare($sql);
    $q->execute();
    $data = $q->fetch();

    
    
    if (empty($email)) {
        $errors['email'] = "you must write email";
    }
    

    //password validation 
    if (empty($password)) {
        $errors['password'] = "you must write password";
    }
    
    



    if (!$errors) {
        $admin_sql = "SELECT email ,password FROM admins WHERE email= '$email'";
        $admin_q = $conn->prepare($admin_sql);
        $admin_q->execute();
        $admin_data = $admin_q->fetch();

        if($admin_data)
        {
            $password_hash = $admin_data['password'] ;
            if(password_verify($password,$password_hash)) 
            {
                $_SESSION['admin'] = [
                    'name' => $data['name'],
                    'email'=> $email 
                ];

                $_POST['email'] = "";
                $_POST['password'] = "";
               
                header("location:../admins/admins.php");
                exit;
            }
        }
      if(!$data) {
            $errors['email'] = "unknown email";
      }
      else {
        $password_hash = $data['password'] ;
        if(!password_verify($password,$password_hash)) {
                $errors['password'] = 'error in login ';
        }else {
                $_SESSION['user'] = [
                    'name' => $data['name'],
                    'email'=> $email 
                ];

                $_POST['email'] = "";
                $_POST['password'] = "";
               
                header("location:../index.php");
                exit();
        }

      }


    }










} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<div class="body">
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" method="POST">

                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="email" placeholder="Email" name="email" value="<?php
                        if (isset($_POST['email'])) {
                            echo $email;
                        }

                        ?>">
                        <br>
                        <div class="error">
                            <?php if (isset($errors['email'])) {
                            echo $errors['email'];
                        } ?>
                        </div>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="password" placeholder="Password" name="password" value="<?php
                        if (isset($_POST['password'])) {
                            echo $password;
                        }

                        ?>">
                        <br>
                        <div class="error">
                            <?php if (isset($errors['password'])) {
                            echo $errors['password'];
                        } ?>
                        </div>
                    </div>
                    <input type="submit" name="submit" class="signup" value="login">
                </form>
                <div class="lol"><a href="signup.php"> dont have an account ?</a></div>
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