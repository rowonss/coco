<?php

$papa = null;
$searchtitle = "";
$searchwriter = "";
$searchDate = "";

$Qstring = $_SERVER["QUERY_STRING"];

if (str_contains($Qstring, 'page')) {
    $papa = $_GET['page'];
}
if (str_contains($Qstring, 'searchtitle')) {
    $searchtitle = $_GET['searchtitle'];
}
if (str_contains($Qstring, 'searchwriter')) {
    $searchwriter = $_GET['searchwriter'];
}
if (str_contains($Qstring, 'searchDate')) {
    $searchDate = $_GET['searchDate'];
}

?>
<style>
    .pageArrow {
        color: black;
        border-radius: 3px;
        background-color: #a0d3e8;
        text-decoration: none;
        border: 1px solid black;
        padding: 3px;
        margin: 5px;
    }

    .pageNum {
        color: black;
        border-radius: 3px;
        background-color: #8bc9e3;
        text-decoration: none;
        border: 1px solid black;
        padding: 5px;
        margin: 5px;
    }

    .pagenation {
        width: 200px;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    let QString = new URLSearchParams(location.search);

    let str1 = "";

    let remain_List_Page = QString.get("page");

    remain_List_Page = Number(remain_List_Page);

    let searchtitle = "";

    let searchwriter = "";

    let searchDate = "";

    if (QString.has("searchtitle")) {
        searchtitle = QString.get("searchtitle");
    }
    if (QString.has("searchwriter")) {
        searchwriter = QString.get("searchwriter");
    }


    let list_view_num = 5;

    let MaxPage = 0;

    let pageList = "";

    let lastPage = false;

    let fail = false;


    function List(page) {

        $.ajax({
            url: "ListPageProcess.php",
            data: {
                searchtitle: searchtitle,
                searchwriter: searchwriter,
                searchDate: searchDate
            },
            async: false,
            type: "POST",
            dataType: "JSON",

            success: function (data) {

                let List = [];

                if(data.length === 0){
                    fail = true;
                }

                $.each(data, function (i) {
                    List.push(data[i]);
                })

                if (List.length % list_view_num === 0) {
                    lastPage = true;
                }


                MaxPage = Math.floor(List.length / list_view_num);

                List.reverse();

                let rePage = [];

                rePage = List.slice(page * list_view_num, page * list_view_num + list_view_num);

                str1 = "";
                pageList = "";

                for (let i = 0; i < rePage.length; i++) {
                    let Seq = "seq=" + rePage[i]['seq'];
                    str1 +=
                        "<tr>" +
                        "<td>" + rePage[i]['seq'] + "</td>" +
                        "<td>" + rePage[i]['mainCategory'] + "</td>" +
                        "<td>" + "<a href='getPage.php?" + Seq + "'" + ">" + rePage[i]['content'] + "</a>" + "</td>" +
                        "<td>" + rePage[i]['fileName'] + "</td>" +
                        "<td>" + rePage[i]['upload_Date'] + "</td>" +
                        "<td>" + rePage[i]['writer'] + "</td>" +
                        "<td>" + rePage[i]['count'] + "</td>" +
                        "</tr>"
                }

                let pageArr = [];

                if (lastPage) {
                    MaxPage -= 1;
                }

                pageList += "<a class='pageArrow'  style='cursor: pointer' onclick='ToFirstPage()'>" + "《" + "</a>";
                pageList += "<a class='pageArrow' style='cursor: pointer' onclick='ToPrevPage()'>" + "〈" + "</a>";

                if (remain_List_Page < 3) {
                    for (let i = 0; i < 5; i++) {
                        if (i === MaxPage + 1) {
                            break;
                        }
                        pageArr.push(i);
                    }
                } else {
                    for (let i = remain_List_Page - 2; i <= remain_List_Page + 2; i++) {
                        if (i === MaxPage + 1) {
                            break;
                        }
                        pageArr.push(i);
                    }
                }

                for (let i = 0; i < pageArr.length; i++) {
                    pageList += "<a class='pageNum' style='cursor: pointer' onclick='ToNumPage(" + pageArr[i] + ")'>" + (pageArr[i] + 1) + "</a>";
                }

                pageList += "<a class='pageArrow' style='cursor: pointer' onclick='ToNextPage()'>" + "〉" + "</a>";
                pageList += "<a class='pageArrow' style='cursor: pointer' onclick='ToLastPage()'>" + "》" + "</a>";

            },

            complete : function (){
                if (remain_List_Page > MaxPage) {
                    ToLastPage();
                }

                if (remain_List_Page < 0) {
                    ToFirstPage();
                }
            }
        })

    }

</script>

<!--페이지 이동 함수-->
<script>
    function MakeURL() {
        let Str = "";
        if (searchtitle !== "") {
            Str += "&searchtitle=" + searchtitle;
        }
        if (searchwriter !== "") {
            Str += "&searchwriter=" + searchwriter
        }

        return Str;
    }

    function ToNumPage(pageNum) {
        let page = "page=" + pageNum;
        let param = MakeURL();
        location.href = "ListPage.php?" + page + param;
    }

    function ToFirstPage() {
        if(fail){
            alert("검색 결과가 없습니다");
            location.href="ListPage.php?page=0";
        }
        else{
            let page = "page=0"
            let param = MakeURL();
            location.href = "ListPage.php?" + page + param;
        }
    }

    function ToLastPage() {
        let page = "page=" + MaxPage.toString();
        let param = MakeURL();
        location.href = "ListPage.php?" + page + param;
    }

    function ToNextPage() {
        let page = "page=" + (remain_List_Page + 1).toString();
        let param = MakeURL();
        location.href = "ListPage.php?" + page + param;
    }

    function ToPrevPage() {
        let page = "page=" + (remain_List_Page - 1).toString();
        let param = MakeURL();
        location.href = "ListPage.php?" + page + param;
    }

</script>

<style>
    .List_Main_Box {
        margin-left: auto;
        margin-right: auto;
        width: 1000px;
    }

    .List_Search_Box {
        border: 1px solid black;
        height: 100px;
    }

    .List_Box {

    }

    .List_Search_Box_Menu > li {
        margin-left: 10px;
        float: left;
        display: inline;
    }

    .List_Search_Box_Menu > li > p {
        margin: 0;
    }

    .List_Box > form > table {
        width: 1000px;
        border-collapse: collapse;
    }

    td {
        border: 1px solid black;
        text-align: center;
    }
</style>

<div class="List_Main_Box">
    <div class="List_Search_Box">
        <form>
            <ul class="List_Search_Box_Menu" style="list-style: none; padding-top: 20px">
                <li><p>제목</p></li>
                <li><label><input type="text" onchange="searchtitle = this.value"
                                  value="<?php echo $searchtitle ?>"></label></li>
                <li><p>작성자</p></li>
                <li><label><input type="text" onchange="searchwriter = this.value" value="<?php echo $searchwriter ?>"></label>
                </li>
                <li><p>작성일</p></li>
                <li><label><input type="date" name="Date" onchange="" value=""></label>~<label>
                        <input type="date" onchange="" value=""></label></li>
                <li><label><input type="button" onclick="ToFirstPage()"></label></li>
            </ul>
        </form>
    </div>
    <div class="List_Box">
        <form>
            <table>
                <tr>
                    <td style="width: 40px">번호</td>
                    <td style="width: 90px">구분</td>
                    <td>제목</td>
                    <td style="width: 50px">첨부</td>
                    <td style="width: 120px">작성일</td>
                    <td style="width: 90px">작성자</td>
                    <td style="width: 90px">조회수</td>
                </tr>

                <script>
                    List(remain_List_Page);
                    document.write(str1);
                </script>

            </table>
        </form>
    </div>
    <div class="pagenation">
        <script>
            document.write(pageList);
        </script>
    </div>
</div>

<script>

</script>