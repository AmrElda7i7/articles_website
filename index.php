<?php session_start();
include("inc/conn.php");
if (isset($_SESSION['user'])):
    $email = $_SESSION['user']['email'];
    $sql = "SELECT email FROM users WHERE email ='$email'";
    $q = $conn->prepare($sql);
    $q->execute();
    $data = $q->fetch();
    if (!$data) {
        unset($_SESSION['user']);
        header("location:message.php");
    }
endif;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <a href="#" class="logo">hope</a>
        <nav class="navigation">
            <a href="categories.php">Articles</a>
            <?php

            if (!isset($_SESSION['user'])    ):


                ?>
                <?php ?> <a href="users/signup.php" class="reg">signup</a>
                <a href="users/login.php" class="login">login</a>
            <?php endif; ?>

            <?php
            if (isset($_SESSION['user'])|| isset($_SESSION['admin']) ):


                ?>
                <?php ?> <a href="users/logout.php" class="logout">logout</a>
                <?php ?> <a href="articles/add_article.php" class="logout">add_article</a>
            <?php endif; ?>
        </nav>
    </header>


    <section class="main">
        <div class="desc">
            <h1>this description for website lol</h1>



        </div>
    </section>


</body>

</html>