<?php

require_once "database.php";

$ListDB = new \database\database();

$List = array();

$searchtitle = $_POST['searchtitle'];

$searchwriter = $_POST['searchwriter'];

$searchStartDate = $_POST['searchStartDate'];

$searchEndDate = $_POST['searchEndDate'];

if($searchStartDate != ""){
    $searchStartDate = intval($searchStartDate);
    $searchEndDate = intval($searchEndDate)+1;
}

$sql = "select * from request";

if($searchtitle != "" && $searchwriter != "" && $searchStartDate != ""){
    $sql = "select * from request where title like '%$searchtitle%' and writer like '%$searchwriter%' and $searchStartDate <= upload_Date and upload_Date <= $searchEndDate";
}

else if($searchtitle != "" && $searchStartDate != ""){
    $sql = "select * from request where title like '%$searchtitle%' and $searchStartDate <= upload_Date and upload_Date <= $searchEndDate";
}

else if($searchwriter != "" && $searchStartDate != ""){
    $sql = "select * from request where writer like '%$searchwriter%' and $searchStartDate <= upload_Date and upload_Date <= $searchEndDate";
}

else if($searchtitle != "" && $searchwriter != ""){
    $sql = "select * from request where title like '%$searchtitle%' and writer like '%$searchwriter%'";
}

else if($searchStartDate != ""){
    $sql = "select * from request where $searchStartDate <= upload_Date and upload_Date <= $searchEndDate";
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