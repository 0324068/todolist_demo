<?php
header('Content-Type:application/json;charset:utf-8');
include('../../db.php');
try{
    $pdo = new PDO("mysql:host=$db[host];dbname=$db[dbname];port=$db[port];charset=$db[charset]",$db['username'],$db['password']);
}catch(PDOException $e){
    echo"connection failed";
    exit;
}; 
    $sql = 'UPDATE todo SET `order`=:order WHERE id=:id';
    $statememt=$pdo->prepare($sql);
foreach ($_POST['orderpair'] as $key => $orderpair) {
   
    $statememt->bindValue(':order', $orderpair['order'],PDO::PARAM_INT);  
    $statememt->bindValue(':id', $orderpair['id'],PDO::PARAM_INT);   
    $result=$statememt->execute();   
}



?>