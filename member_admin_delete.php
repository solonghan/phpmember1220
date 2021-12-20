<?php
require_once("connmysql.php");
  session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}
//檢查權限是否足夠
if($_SESSION["level"]=="member"){
	header("Location: member_common.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["level"]);
	header("Location: index.php");
}
//執行刪除動作
if(isset($_POST["action"])&&($_POST["action"]=="delete")){
        $sql_delete ="DELETE FROM memberdata WHERE m_id=".$_GET['id'];
        print $sql_delete;
        mysqli_query($conn,$sql_delete);
        mysqli_close($conn);
        header("Location:member_admin.php");
    }
    $sql = "SELECT * FROM `memberdata` WHERE `m_id`=" . $_GET["id"];
    $result = mysqli_query($conn,$sql);
    $arr = mysqli_fetch_array($result,MYSQLI_ASSOC);

   //繫結登入會員資料
   $sql_admin = "SELECT * FROM memberdata WHERE m_username = '".$_SESSION["loginMember"]."'";
   $result_admin= mysqli_query($conn,$sql_admin);
   $arr_admin= mysqli_fetch_assoc($result_admin);
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>加入會員系統</title>
    <script language="javascript">
       function deletesure(){
            if (confirm('\n您確定要刪除這個會員嗎?\n刪除後無法恢復!\n')) return true;
            return false;
        }
    </script>
</head>
<body class="body_1">
    <div style="margin:auto; width:800px">
    <h1>網站會員系統</h1>
    <div class="div_1">
    <form action="" method="POST" name="formJoin" id="formJoin" onsubmit="return deletesure();">
        <div class="div_3">
            <h2>要刪除的會員資料</h2>
            <?php if(isset($_GET["err"]) && ($_GET["err"]=="1")){?>
            <p><?php echo $_GET["username"];?></p>  
                <?php }?>
            <hr>
            <h3>帳號資料</h3>
            <p>
            <strong>使用帳號:</strong>
            <span><?php print $arr["m_username"];  ?></span>
            </p>    
            <p>
            <hr>
            <h3>個人資料</h3>
            <p>
            <strong>真實姓名:</strong>
            <span><?php print $arr["m_name"];  ?></span>
            </p>    
            <p>
            <strong>性&emsp;&emsp;別:</strong>
            <span><?php print $arr["m_sex"];  ?></span>
            </p>    
            <p>
            <strong>生&emsp;&emsp;日:</strong>
            <span><?php print $arr["m_birthday"];  ?></span>
            </p>    
            <strong>電子郵件:</strong>
            <span><?php print $arr["m_email"];  ?></span>
            </p>    
            <p>
            <strong>個人網頁:</strong>
            <span><?php print $arr["m_url"];  ?></span>
            </p>   
            <p>
            <strong>電&emsp;&emsp;話:</strong>
            <span><?php print $arr["m_phone"];  ?></span>
            
            </p>   
            <p>
            <strong>住&emsp;&emsp;址:</strong>
            <span><?php print $arr["m_address"];  ?></span>
            <hr>
            </p>   
            <p style="text-align: center;">
            <input name="action" type="hidden" id="action" value="delete">
            <input type="hidden" name="m_id" value="<?php print $arr["m_id"];?>">
            <input type="submit" name="Submit2" value="確定刪除資料" class="input_1">
            
            <input type="button" name="Submit" value="回上一頁" onclick="window.history.back();" class="input_1">
          </p> 
        </div>
        </form>
        <div class="div_2_h220">
        <h3>管理會員系統</h3>
        <p><?php print $arr_admin['m_name']?> ，你好。</p>
             <p>本次登入時間為:</p>
             <p><?php print $arr_admin['m_logintime']?> </p>
            <div>
                <a href='member_admin.php' class="a_2">管理中心</a>
                <a href="?logout=true" class="a_2">登出系統</a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>