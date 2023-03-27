<?php

require_once "database.php";

$ListDB = new \database\database();

$List = array();

$searchtitle = $_POST['searchtitle'];

$searchwriter = $_POST['searchwriter'];

$searchDate = $_POST['searchDate'];

$sql = "select * from request";

if($searchtitle != "" && $searchwriter != ""){
    $sql = "select * from request where title like '%$searchtitle%' and writer like '%$searchwriter%'";
}

else if($searchtitle != ""){
    $sql = "select * from request where title like '%$searchtitle%'";
}

else if($searchwriter != ""){
    $sql = "select * from request where writer like '%$searchwriter%'";
}


try {
    $connect = $ListDB->newDB();
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $List = $connect->query($sql)->fetchAll();

    echo json_encode($List);

}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}
$connect = null;