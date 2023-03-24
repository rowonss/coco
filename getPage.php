<?php

require_once "database.php";

$seq = $_GET['seq'];

$getpageDB = new \database\database();

$mainCategory = "";
$writer = "";
$category = "";
$customerType = "";
$title = "";
$content = "";
$file = "";
$fileName = "";

try {
    $connect = $getpageDB->newDB();
    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE request SET count = count + 1 WHERE seq = '$seq';";
    $sql2 = "SELECT * FROM request WHERE seq LIKE '$seq'";
    $connect->exec($sql);
    $result =  $connect->query($sql2);

    foreach ($result as $a){
        $mainCategory = $a['mainCategory'];
        $writer = $a['writer'];
        $content = $a['content'];
        $category = $a['catgegory'];
        $customerType = $a['customerType'];
        $title = $a['title'];
    }
}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}

$connect = null;

?>
<style>
    table, tr, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    tr > td:first-child {
        width: 150px;
        text-align: center;
        padding-top: 7px;
        padding-bottom: 7px;
        background-color: #8bc9e3;
    }

    tr > td:nth-child(2) {
        width: 500px;
        padding: 10px;
    }

    tr > td > label > input[type=text] {
        height: 30px;
    }
</style>
<div>
    <form name="InsertForm" action="InsertProcess.php" method="post" style="width:700px; margin-left: auto; margin-right: auto">
        <table>
            <tr>
                <td><p>구분</p></td>
                <td><?php echo "$mainCategory" ?></td>
            </tr>
            <tr>
                <td><p>작성자</p></td>
                <td><?php echo "$writer" ?></td>
            </tr>
            <tr>
                <td><p>분류</p></td>
                <td><?php echo "$category" ?></td>
            </tr>
            <tr>
                <td><p>고객 유형</p></td>
                <td><?php echo "$customerType" ?></td>
            </tr>
            <tr>
                <td><p>제목</p></td>
                <td><?php echo "$title" ?></td>
            </tr>
            <tr>
                <td><p>내용</p></td>
                <td><?php echo "$content" ?></td>
            </tr>
            <tr>
                <td><p>첨부파일</p></td>
                <td></td>
            </tr>
        </table>
        <input type="button" onclick="check()">
    </form>
</div>