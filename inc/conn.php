<?php
$user = "root";
$dbname = "article_website";
$password = "";

try {


    $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user, $password);
    
}
catch (Exception $e ) {
   echo $e->getMessage() ;
}
