<?php

$dsn = 'mysql:host=localhost; dbname=bricks';
$user = 'root';
$pass = '';

try{
    $cnx = new PDO($dsn, $user, $pass); 
   // $database = new PDO('mysql:host=localhost; dbname=bricks', 'root', '');


} catch(PDOException $e){
    echo 'Une erreur est survenue!';
}


?>