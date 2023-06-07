<?php
include("../inc/conn.php");
$sql = " SELECT articles.id as id,users.name as author , title , date_time ,image ,categories.name category FROM users
 INNER JOIN articles ON users.id = articles.uid 
 INNER JOIN categories ON articles.id = categories.article_id ORDER BY date_time" ;
$q = $conn->prepare($sql);
$q->execute();
$datas = $q->fetchAll();


// 
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
        <th>author</th>
        <th>button</th>
        <th>title</th>
        <th>date</th>
        <th>category</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($datas as $data) { 
        ?>
        <tr>
          <td><?php
          $id = $data['id'];
          $image = $data['image'];
          echo $data['id'] ?></td>
          <td>
            <?php echo $data['author'] ?>
          </td>
          <td><button><a href="delete_article.php?id=<?php echo $id ?>&image=<?php echo $image ?>">delete</a></button></td>
          <td>
            <?php echo $data['title']; ?>
        </td>
          <td>
            <?php echo $data['date_time'];     ?>
        </td>
          <td>
            <?php echo $data['category'];} ?>
        </td>
      </tr>


    </tbody>
  </table>

</body>

</html>