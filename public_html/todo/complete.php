<?php
header('Content-Type:application/json;charset:utf-8');
include('../../db.php');
try{
    $pdo = new PDO("mysql:host=$db[host];dbname=$db[dbname];port=$db[port];charset=$db[charset]",$db['username'],$db['password']);
}catch(PDOException $e){
    echo"connection failed";
    exit;
};
$sql = 'SELECT iscomplete FROM todo WHERE id=:id';
$statememt=$pdo->prepare($sql);  
$statememt->bindValue(':id',$_POST['id'],PDO::PARAM_INT);   
$result=$statememt->execute();
$todo = $statememt->fetch(PDO::FETCH_ASSOC);

$sql = 'UPDATE todo SET iscomplete=:iscomplete WHERE id=:id';
$statememt=$pdo->prepare($sql);
$statememt->bindValue(':id',$_POST['id'],PDO::PARAM_INT);  
$statememt->bindValue(':iscomplete',!$todo['iscomplete'],PDO::PARAM_INT);  
$result=$statememt->execute();

echo json_encode(['id'=>$_POST['id'],'iscomplete'=>!$todo['iscomplete']]);
?>