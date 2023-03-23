<?php


require_once "database.php";

$mainCategory = $_POST["Insert_mainCategory"];
$writer = $_POST["Insert_writer"];
$category = $_POST["Insert_category"];
$customerType = $_POST["Insert_customerType"];
$title = $_POST["Insert_title"];
$content = $_POST["Insert_content"];
$file = $_POST["Insert_file"];
$fileName = $_POST["Insert_fileName"];

$dd = new \database\database();

//echo "<script>alert('php로 alert띄우기!');</script>";

try {
    $connect = $dd->newDB();
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = "insert into request (seq,mainCategory,writer,catgegory,customerType,title,content,fileName,upload_Date)
        values (default,'$mainCategory','$writer','$category','$customerType','$title','$content','$fileName',default)";
    $connect->exec($sql);
    echo '성공';
}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}
$connect = null;


