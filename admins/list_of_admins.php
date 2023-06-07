<?php
session_start();
$email = $_SESSION['admin']['email'];
include("../inc/conn.php");
$sql = "SELECT id,name ,email FROM admins where email !='$email'";
$q = $conn->prepare($sql);
$q->execute();
$datas = $q->fetchAll();



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <table class="styled-table">
    <thead>
      <tr>
        <th>id</th>
        <th>Name</th>
        <th>email</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($datas as $data) { ?>
        <tr>
          <td><?php
          $id = $data['id'];
           echo $data['id'] ?></td>
          <td>
            <?php echo $data['name'] ?>
          </td>
          <td><?php echo $data['email'];} ?></td>
      </tr>

      
    </tbody>

</body>

</html>