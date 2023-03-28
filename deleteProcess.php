<?php

require_once "database.php";

$seq = $_GET['seq'];

$getpageDB = new \database\database();



try {
    $connect = $getpageDB->newDB();
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = "delete from request where seq = '$seq'";
    $connect->exec($sql);

    echo "<script>alert('삭제가 완료 되었습니다');</script>";
    echo "<script>location.href='ListPage.php?page=0'</script>";

}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}

$connect = null;
