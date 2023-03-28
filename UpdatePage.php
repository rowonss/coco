<?php

require_once "database.php";

$seq = $_POST['seq'];

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
    $sql2 = "SELECT * FROM request WHERE seq LIKE '$seq'";
    $result =  $connect->query($sql2);

    foreach ($result as $a){
        $seq = $a['seq'];
        $mainCategory = $a['mainCategory'];
        $writer = $a['writer'];
        $content = $a['content'];
        $category = $a['catgegory'];
        $customerType = $a['customerType'];
        $title = $a['title'];
        $fileName = $a['fileName'];
    }
}
catch (PDOException $ex){
    echo '실패:'.$ex->getMessage();
}

$connect = null;

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    let maincategory = 1;
    let category = "<?php echo $category ?>";
    let customerType = <?php echo (substr_count($customerType,",")+1) ?>;
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
        padding: 10px;
    }

    tr > td > label > input[type=text] {
        height: 30px;
    }
</style>
<div>
    <form name="InsertForm" action="UpdatePageProcess.php" method="post" enctype="multipart/form-data"
          style="width:700px; margin-left: auto; margin-right: auto">
        <input type="hidden" name="seq" value="<?php echo $seq ?>">
        <table>
            <tr>
                <td><p>구분</p></td>
                <td><label>
                        <select onchange="maincategory = 1 " name="Insert_mainCategory" required>
                            <option value="" disabled selected>선택해주세요</option>
                            <option id="maincategory_main" value="유지보수">유지보수</option>
                            <option id="maincategory_QnA" value="문의사항">문의사항</option>
                        </select>
                    </label>
                    <p style="display: inline">(유지보수,문의사항)</p></td>
            </tr>
            <tr>
                <td><p>작성자</p></td>
                <td><label>
                        <input type="text" id="writer" onchange="writer=this.value" name="Insert_writer" value="<?php echo $writer ?>">
                    </label></td>
            </tr>
            <tr>
                <td><p>분류</p></td>
                <td><label>
                        <input id="radio_homepage" type="radio" onchange="category=this.value" name="Insert_category" value="홈페이지">
                    </label>홈페이지
                    <label>
                        <input id="radio_network" type="radio" onchange="category=this.value" name="Insert_category" value="네트워크">
                    </label>네트워크
                    <label>
                        <input id="radio_server" type="radio" onchange="category=this.value" name="Insert_category" value="서버">
                    </label>서버
                </td>
            </tr>
            <tr>
                <td><p>고객 유형</p></td>
                <td><label>
                        <input id="Type_hosting" type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="호스팅">
                    </label>호스팅
                    <label>
                        <input id="Type_maint" type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="유지보수">
                    </label>유지보수
                    <label>
                        <input id="Type_serverRental" type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="서버 임대">
                    </label>서버 임대
                    <label>
                        <input id="Type_others" type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="기타">
                    </label>기타
                </td>
            </tr>
            <tr>
                <td><p>제목</p></td>
                <td><label>
                        <input type="text" id="title" onchange="title=this.value" name="Insert_title" style="width: 500px;" value="<?php echo $title ?>">
                    </label></td>
            </tr>
            <tr>
                <td><p>내용</p></td>
                <td>
                    <label>
                        <textarea name="Insert_content" id="content" onchange="content=this.value"
                                  style="width: 500px; height: 300px; resize: none"><?php echo $content ?></textarea>
                    </label>
                </td>
            </tr>
            <tr>
                <td><p>첨부파일</p></td>
                <td>
                    <label>
                        <input type="text" id="fileName" name="Insert_fileName" value="<?php echo $fileName ?>" readonly>
                        <input type="file" name="Insert_file" style="color: transparent"
                               onchange="document.getElementById('fileName').value=this.files[0].name">
                    </label>
                </td>
            </tr>
        </table>
        <input type="button" onclick="check()">
    </form>
</div>

<script>

    function check() {
        if (maincategory === 0) {
            alert("구분을 선택해 주세요")
        } else if (document.getElementById('writer').value.length === 0) {
            alert("작성자를 입력해 주세요");
        } else if (category.length === 0) {
            alert("분류를 선택해 주세요");
        } else if (customerType === 0) {
            alert("고객 유형을 한 개 이상 선택해 주세요");
        } else if (document.getElementById('title').value.length === 0) {
            alert("제목을 입력해 주세요");
        } else if (document.getElementById('content').value.length === 0) {
            alert("내용을 입력해 주세요")
        } else {
            document.InsertForm.submit();
        }
    }

    function customerTypeCheck() {

        const query = 'input[name="Insert_customerType[]"]:checked';
        const selectedElements = document.querySelectorAll(query);
        customerType = selectedElements.length;

    }

    let radioChk = "<?php echo $category ?>";
    let TypeChk = "<?php echo $customerType ?>"

    if(radioChk === "홈페이지"){
        $("input[id=radio_homepage]").attr("checked","checked");
    }
    else if(radioChk === "네트워크"){
        $("input[id=radio_network]").attr("checked","checked");
    }
    else{
        $("input[id=radio_server]").attr("checked","checked");
    }

    if(TypeChk.includes("호스팅")){
        $("input[id=Type_hosting]").attr("checked","checked");
    }
    if(TypeChk.includes("유지보수")){
        $("input[id=Type_maint]").attr("checked","checked");
    }
    if(TypeChk.includes("서버 임대")){
        $("input[id=Type_serverRental]").attr("checked","checked");
    }
    if(TypeChk.includes("기타")){
        $("input[id=Type_others]").attr("checked","checked");
    }

    let MainCate = "<?php echo $mainCategory ?>";

    if(MainCate === "유지보수"){
        $("option[id=maincategory_main]").attr("selected","selected");
    }

    if(MainCate === "문의사항"){
        $("option[id=maincategory_QnA]").attr("selected","selected");
    }



</script>
