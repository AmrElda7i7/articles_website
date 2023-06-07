<?php
include("../inc/conn.php");
$sql = " SELECT title , body , image ,name ,id FROM articles inner join categories on articles.id = categories.article_id where name ='psychology'";
$q = $conn->prepare($sql);
$q->execute();
$datas = $q->fetchAll();

foreach ($datas as $data) 
{
    $image = $data['image'] ;
    $id = $data['id'] ;     
    echo $data['title'];

    echo "<img src='../uploads/$image' >";
    echo "<a href='../articles_to_read/posts.php?id=$id'>read more</a>";
}
?> 

