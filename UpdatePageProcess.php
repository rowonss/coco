<?php

require_once "database.php";

$seq = $_POST["seq"];
$mainCategory = $_POST["Insert_mainCategory"];
$writer = $_POST["Insert_writer"];
$category = $_POST["Insert_category"];
$customerType = $_POST["Insert_customerType"];
$title = $_POST["Insert_title"];
$content = $_POST["Insert_content"];
$file = $_FILES["Insert_file"];
$fileName = $_FILES["Insert_file"]["name"];

$dd = new \database\database();

$nowDate = date("Y-m-d H:i:s");

echo "$_SERVER[QUERY_STRING]";

$CustomerTypeStr = "";

if(sizeof($customerType) > 0){
    for($i = 0; $i<sizeof($customerType); $i++){
        $CustomerTypeStr .= $customerType[$i].=",";
    };
    $CustomerTypeStr = substr($CustomerTypeStr,0,-1);
}

try {
    $connect = $dd->newDB();
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE request SET mainCategory = '$mainCategory', writer = '$writer', catgegory = '$category', customerType = '$CustomerTypeStr', title = '$title', content = '$content', fileName = '$fileName', Update_Date='$nowDate' where seq = '$seq'";
    $connect->exec($sql);

    echo $fileName;

    if($fileName != ""){
        $path = "./upload/$seq";
        $tmp_name = $file['tmp_name'];
        mkdir($path,0777,true);
        chmod($path,0777);
        $up = move_uploaded_file($tmp_name, "$path/$fileName");
    }

    echo "<script>alert('수정이 완료 되었습니다');</script>";
    echo "<script>location.href='ListPage.php?page=0'</script>";
}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}
$connect = null;

