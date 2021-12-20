<?php
    require_once("connmysql.Php");
    session_start();
    //檢查是否經過登入
    if(!isset($_SESSION['loginMember']) || ($_SESSION['loginMember']=="")){
            header("Location:index.php");  
    }
    //執行登出動作
    if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["level"]);
	header("Location: index.php");
    }
    //繫結登入會員資料
    $sql = "SELECT * FROM memberdata WHERE m_username = '".$_SESSION["loginMember"]."'";
    $result= mysqli_query($conn,$sql);
    $arr= mysqli_fetch_assoc($result);

    $sql_list= "SELECT `m_id`,`m_name`,`m_username`,`m_jointime`,`m_logintime`,`m_login` FROM `memberdata` ORDER BY `m_jointime` DESC ";
    $result_list=mysqli_query($conn,$sql_list);
    //預設每頁筆數
    $pagerRow_records = 5;
    //預設頁數
    $num_page = 1;
    if(isset($_GET["page"])){
        $num_page = $_GET["page"];
    }
     //本頁開始記錄筆數=(頁數-1)*每頁紀錄筆數
    $startRow_records = ($num_page-1)*$pagerRow_records;
    $sql_limit =$sql_list . "LIMIT " . $startRow_records . ", " . $pagerRow_records;
    $data_page= mysqli_query($conn,$sql_limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>管理會員系統</title>
</head>
<body class="body_1">
    <div style="margin:auto; width:800px;">
    <h1 class="h1_w830">管理會員系統</h1>
    <div class="div_1_w800">
        <div class="div_3_w600">
        <h2>會員資料列表</h2>
    <?php
    if($result_limit = mysqli_query($conn,$sql_limit)){
        $total_records =mysqli_num_rows($result_limit);
        //print $total_records;//印出本頁 N 筆資料
        $all_result = mysqli_query($conn,$sql_list);
        $total_records =mysqli_num_rows($all_result);
        //計算總頁數=(總比數/每頁筆數) 無條件進位
        $total_pages= ceil($total_records/$pagerRow_records);
        // print "總頁數:".$total_pages;
        print "<table>";
        print "<tr>";
        print  "<th style='width:8%'>&nbsp;</th>";
        print  "<th style='width:10%'>姓名</th>";
        print  "<th style='width:10%'>帳號</th>";
        print  "<th style='width:12%'>加入時間</th>";
        print  "<th style='width:12%'>上次登入</th>";
        print  "<th style='width:5%'>登入</th> ";
        print "</tr>";
        
        while( $arr_list=mysqli_fetch_assoc($data_page)){

            print "<tr>";
            print "<td style='text-align:center'><a href='member_admin_update.php?id=".$arr_list['m_id']."' class='a_3'>修改</a><br><a href='member_admin_delete.php?id=".$arr_list['m_id']."' class='a_4'>刪除</a></td>";
            print "<td style='width:10%'>".$arr_list['m_name']."</td>";
            print "<td style='width:10%'>".$arr_list['m_username']."</td>";
            print "<td style='width:12%'>".$arr_list['m_jointime']."</td>";
            print "<td style='width:12%'>".$arr_list['m_logintime']."</td>";
            print "<td style='text-align:center'>".$arr_list['m_login']."</td>";
            print "</tr>";
        }
        
        print "</table>";
    }
    print "<div style='float: left;'>";
    print "<span>總會員數:".$total_records."</span>" ;
    print "</div>";
    print "<div style='text-align:right;width: 580px;'>";

    //分頁設定
    if($num_page>1){
        print "<a href='member_admin.php?page=1' class='a_10'>第一頁&nbsp</a>";
        print "<a href='member_admin.php?page=". ($num_page-1) . "' class='a_10'>上一頁&nbsp</a>";
    }
    
    if($num_page<$total_pages){
        print "<a href='member_admin.php?page=". ($num_page+1) . "' class='a_10'>下一頁&nbsp</a>";
        print "<a href='member_admin.php?page=". $total_pages . "' class='a_10'>最後一頁</a>";
    }
    print "</div>";
    ?>
    </div>
        <div class="div_2_h220">
            <h3>管理會員系統</h3>
             <p><?php print $arr['m_name']?> ，你好。</p>
             <p>本次登入時間為:</p>
             <p><?php print $arr['m_logintime']?> </p>
            <div>
                <a href='member_admin_update.php?id=<?php print $arr
                ['m_id']?>' class="a_2">修改資料</a>
                <a href="?logout=true" class="a_2">登出系統</a>
            </div>
        </div>
    </div>
    </div>
    
</body>
</html>
