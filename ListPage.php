<?php


$papa = null;
$searchString = "null";
$Date = "null";

echo $_SERVER["QUERY_STRING"];

$Qstring = $_SERVER["QUERY_STRING"];

if(str_contains($Qstring,'page')){
    $papa = $_GET['page'];
}
else if(str_contains($Qstring,'searchString')){
    $searchString = $_GET['searchString'];
}


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    let str1 = "";
    let remain_List_Page = <?php echo $papa?>;

    let list_view_num = 5;

    let MaxPage = 0;

    let pageList = "";

    function List(page) {
        $.ajax({
            url: "ListPageProcess.php",
            data:{
                searchString : <?php echo $searchString ?>,
                Date : <?php echo $Date ?>
            },
            async: false,
            type: "POST",
            dataType: "JSON",
            success: function (data) {

                let List = [];

                $.each(data, function (i) {
                    List.push(data[i]);
                })

                MaxPage = Math.floor(List.length/list_view_num);

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

                pageList += "<a href=ListPage.php?page=0>" + "◀◀" + "</a>";

                if(remain_List_Page < 3){
                    for(let i=0; i<5; i++){
                        if(i === MaxPage+1){
                            break;
                        }
                        pageArr.push(i);
                    }
                }
                else{
                    for(let i=remain_List_Page-2; i<=remain_List_Page+2; i++){
                        if(i === MaxPage+1){
                            break;
                        }
                        pageArr.push(i);
                    }
                }

                console.log(remain_List_Page)
                console.log(pageArr)

                for(let i=0; i<pageArr.length; i++){
                    pageList += "<a href=ListPage.php?page="+ pageArr[i] + ">" + (pageArr[i]+1) + "</a>";
                }

                pageList += "<a href=ListPage.php?page="+ MaxPage + ">" + "▶▶" + "</a>";
                

            }
        })
    }

    <?php
    echo "List($papa)";
    ?>

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
        <div>
            <ul class="List_Search_Box_Menu" style="list-style: none; padding-top: 20px">
                <li><p>제목</p></li>
                <li><label><input type="text"></label></li>
                <li><p>작성자</p></li>
                <li><label><input type="text"></label></li>
                <li><p>작성일</p></li>
                <li><label><input type="date"></label>~<label><input type="date"></label></li>
                <li><label><input type="button"></label></li>
            </ul>
        </div>
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
                    document.write(str1);
                </script>

            </table>
        </form>
    </div>
    <div>
        <script>
            document.write(pageList);
        </script>
    </div>
</div>

<script>

</script>