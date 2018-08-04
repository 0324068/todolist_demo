<?php
header('Content-Type:application/json;charset:utf-8');
include('../../db.php');
try{
    $pdo = new PDO("mysql:host=$db[host];dbname=$db[dbname];port=$db[port];charset=$db[charset]",$db['username'],$db['password']);
}catch(PDOException $e){
    echo"connection failed";
    exit;
};

$sql = 'UPDATE todo SET content=:content WHERE id=:id';
$statememt=$pdo->prepare($sql);
$statememt->bindValue(':content',$_POST['content'],PDO::PARAM_STR);  
$statememt->bindValue(':id',$_POST['id'],PDO::PARAM_INT);   
$result=$statememt->execute();


?>