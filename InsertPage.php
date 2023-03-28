<?php

?>
<script>
    let maincategory = 0;
    let category = "";
    let customerType = 0;
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
    <form name="InsertForm" action="InsertProcess.php" method="post" enctype="multipart/form-data"
          style="width:700px; margin-left: auto; margin-right: auto">
        <table>
            <tr>
                <td><p>구분</p></td>
                <td><label>
                        <select onchange="maincategory = 1 " name="Insert_mainCategory" required>
                            <option value="" disabled selected>선택해주세요</option>
                            <option value="유지보수">유지보수</option>
                            <option value="문의사항">문의사항</option>
                        </select>
                    </label>
                    <p style="display: inline">(유지보수,문의사항)</p></td>
            </tr>
            <tr>
                <td><p>작성자</p></td>
                <td><label>
                        <input type="text" id="writer" onchange="writer=this.value" name="Insert_writer">
                    </label></td>
            </tr>
            <tr>
                <td><p>분류</p></td>
                <td><label>
                        <input type="radio" onchange="category=this.value" name="Insert_category" value="홈페이지">
                    </label>홈페이지
                    <label>
                        <input type="radio" onchange="category=this.value" name="Insert_category" value="네트워크">
                    </label>네트워크
                    <label>
                        <input type="radio" onchange="category=this.value" name="Insert_category" value="서버">
                    </label>서버
                </td>
            </tr>
            <tr>
                <td><p>고객 유형</p></td>
                <td><label>
                        <input type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="호스팅">
                    </label>호스팅
                    <label>
                        <input type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="유지보수">
                    </label>유지보수
                    <label>
                        <input type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="서버 임대">
                    </label>서버 임대
                    <label>
                        <input type="checkbox" onclick="customerTypeCheck()" name="Insert_customerType[]" value="기타">
                    </label>기타
                </td>
            </tr>
            <tr>
                <td><p>제목</p></td>
                <td><label>
                        <input type="text" id="title" onchange="title=this.value" name="Insert_title" style="width: 500px;">
                    </label></td>
            </tr>
            <tr>
                <td><p>내용</p></td>
                <td>
                    <label>
                        <textarea name="Insert_content" id="content" onchange="content=this.value"
                                  style="width: 500px; height: 300px; resize: none"></textarea>
                    </label>
                </td>
            </tr>
            <tr>
                <td><p>첨부파일</p></td>
                <td>
                    <label>
                        <input type="text" id="fileName" name="Insert_fileName" readonly>
                        <input type="file" name="Insert_file" style="color: transparent"
                               onchange="document.getElementById('fileName').value=this.files[0].name"
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

</script>
