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
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE request SET count = count + 1 WHERE seq = '$seq';";
    $sql2 = "SELECT * FROM request WHERE seq LIKE '$seq'";
    $connect->exec($sql);
    $result = $connect->query($sql2);

    foreach ($result as $a) {
        $seq = $a['seq'];
        $mainCategory = $a['mainCategory'];
        $writer = $a['writer'];
        $content = $a['content'];
        $category = $a['catgegory'];
        $customerType = $a['customerType'];
        $title = $a['title'];
        $fileName = $a['fileName'];
    }
} catch (PDOException $ex) {
    echo '실패:' . $ex->getMessage();
}

$connect = null;

?>

<script>
    function UpdatePage(Seq) {

        let P = document.getForm;

        P.setAttribute('method', 'post');

        P.setAttribute('action', 'UpdatePage.php');

        P.seq.value = Seq;

        P.submit();
    }
</script>

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

    .buttonList > li {
        float: left;
        border-radius: 3px;
        border: 1px solid black;
        padding: 5px;
        margin-left: 10px;
    }
</style>
<div>
    <form name="getForm" style="width:700px; margin-left: auto; margin-right: auto">
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
                <td style="width: 500px; height: 300px;"><?php echo "$content" ?></td>
            </tr>
            <tr>
                <td><p>첨부파일</p></td>
                <td><?php echo "$fileName" ?>
                    <div style="cursor: pointer; border: 1px solid black; border-radius: 3px; padding: 5px; display: inline; margin-left: 10px"
                         onclick="download()">다운로드
                    </div>
                </td>
            </tr>
        </table>
        <input type="hidden" name="seq">
        <ul class="buttonList" style="list-style: none">
            <li><a style="cursor: pointer" onclick="UpdatePage(<?php echo $seq ?>)">수정</a></li>
            <li><a style="cursor: pointer" onclick="deletePage()">삭제</a></li>
            <li><a style="cursor: pointer" onclick="history.back()">목록</a></li>
        </ul>
    </form>
</div>

<script>
    function deletePage() {
        if (window.confirm("글을 삭제 하시겠습니까?")) {
            location.href = "deleteProcess.php?seq=<?php echo $seq ?>"
        }
    }

    function download() {
        if (window.confirm("파일을 다운로드 하시겠습니까?")) {
            location.href = "fileDownload.php?fileName=<?php echo $fileName ?>&seq=<?php echo $seq ?>"
        }
    }
</script>