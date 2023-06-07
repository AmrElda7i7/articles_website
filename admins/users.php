<?php
session_start();
include("../inc/conn.php");
$sql = "SELECT id,name ,email FROM users";
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
        <th>button</th>
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
          <td><button ><a href="delete_user.php?id=<?php echo $id ?>">delete</a></button></td>
          <td><?php echo $data['email'];} ?></td>
      </tr>

      
    </tbody>

</body>

</html>