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
    $sql = "insert into request (seq,mainCategory,writer,catgegory,customerType,title,content,fileName,upload_Date)
        values (default,'$mainCategory','$writer','$category','$CustomerTypeStr','$title','$content','$fileName',default)";
    $connect->exec($sql);

    echo "<script>alert('작성이 완료 되었습니다');</script>";
    echo "<script>location.href='ListPage.php?page=0'</script>";
}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}
$connect = null;






