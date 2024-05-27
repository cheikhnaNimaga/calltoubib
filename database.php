<?php

$dsn="mysql:dbname=calltoubib;host=localhost";
try{
    $connexion=new PDO($dsn,"root","");
    return $connexion;
}
catch(PDOException $e){
    
    printf("Échec de la connexion : %s\n", $e->getMessage());
    exit();

}
?>