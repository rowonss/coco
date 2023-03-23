<?php

require_once "database.php";

$ListDB = new \database\database();

$List = array();

try {
    $connect = $ListDB->newDB();
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = "select * from request";

    $List = $connect->query($sql)->fetchAll();

    echo json_encode($List);
}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}
$connect = null;