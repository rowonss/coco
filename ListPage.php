<?php

//require_once "database.php";
//
//$ListDB = new \database\database();
//
//$List = array();
//
//try {
//    $connect = $ListDB->newDB();
//    $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//    $sql = "select * from request";
//
//    $List = $connect->query($sql);
//
//    foreach ($List as $a){
//        echo $a["seq"];
//    }
//
//    echo '성공';
//}
//catch (PDOException $ex){
//    echo '실패:'.$ex->getMessage();
//}
//$connect = null;


?>

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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script type="text/javascript">

                    let str1 = "";
                    let remain_List_Page = 1;
                    let list_view_num = 10;

                    $.ajax({
                        url: "ListPageProcess.php",
                        async:false,
                        type: "get",
                        dataType:"JSON",
                        success:function (data){

                            let List = [];

                            $.each(data, function (i){
                                List.push(data[i]);
                            })
                            console.log(List[3]['customerType']);
                            for(let i=0; i<List.length; i++){
                                str1 +=
                                    "<tr>"+
                                    "<td>" + List[i]['seq'] + "</td>" +
                                    "<td>" + List[i]['mainCategory'] + "</td>" +
                                    "<td>" + List[i]['title'] + "</td>" +
                                    "<td>" + List[i]['fileName'] + "</td>" +
                                    "<td>" + List[i]['upload_Date'] + "</td>" +
                                    "<td>" + List[i]['writer'] + "</td>" +
                                    "<td>" + List[i]['seq'] + "</td>" +
                                    "</tr>"
                            }
                        }
                    })

                    function getRquest (seq){
                        
                    }

                </script>

                <?php
                $ww = "<script>document.write(str1);</script>";
                echo ($ww);
                ?>


            </table>
        </form>
    </div>
</div>

<script>

</script>