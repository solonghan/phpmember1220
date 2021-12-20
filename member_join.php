<?php
if(isset($_POST["action"])&&($_POST["action"]=="join")){
        require_once("connmysql.php");
        $sql= "SELECT `m_username` FROM `memberdata` WHERE `m_username`='" .$_POST["m_username"]."'" ;
        $result =mysqli_query($conn,$sql);
        $arr= mysqli_fetch_assoc($result);
        $arr_row=mysqli_num_rows($result);
        
        if($arr_row==0){
            $sql_add="INSERT INTO `memberdata`(`m_name`,`m_username`,`m_passwd`,`m_sex`,`m_birthday`,`m_email`,`m_url`,`m_phone`,`m_address`,`m_jointime`) VALUES (";
            $sql_add .="'" . GetSQLValueString($_POST['m_name'],'string') ."',";
            $sql_add .="'" . GetSQLValueString($_POST['m_username'],'string') ."',";
            $sql_add .="'" . password_hash($_POST["m_passwd"], PASSWORD_DEFAULT) ."',";
            $sql_add .="'" . GetSQLValueString($_POST['m_sex'],'string') ."',";
            $sql_add .="'" . GetSQLValueString($_POST['m_birthday'],'string') ."',";
            $sql_add .="'" . GetSQLValueString($_POST['m_email'],'email') ."',";
            $sql_add .="'" . GetSQLValueString($_POST['m_url'],'url') ."',";
            $sql_add .="'" . GetSQLValueString($_POST['m_phone'],'int') ."',";
            $sql_add .="'" . GetSQLValueString($_POST['m_address'],'string') ."',";
            $sql_add .="  NOW())";
            $result_add= mysqli_query($conn,$sql_add);
            mysqli_close($conn);  
            header("Location: member_join.php?loginStats=1");
        }else{
            header("Location:member_join.php?err=1&username=".$_POST["m_username"]);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>加入會員系統</title>
    <script language="javascript" src="script_join.js"></script> 
</head>
<body class="body_1">
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('會員新增成功\n請用申請的帳號密碼登入。');
window.location.href='index.php';		  
</script>
<?php }?>
    <div style="margin:auto; width:800px">
    <h1>網站會員系統</h1>
    <div class="div_1">
    <form action="" method="POST" name="formJoin" id="formJoin" onsubmit="return checkForm();">
        <div class="div_3">
            <h2>加入會員</h2>
            <hr>
            <?php if(isset($_GET["err"]) && ($_GET["err"]=="1")){?>
            <p class="p_2"><?php echo $_GET["username"]."有人使用了!";?></p>  
                <?php }?>
            <h3>帳號資料</h3>
            <p>
            <strong>使用帳號:</strong>
            <input type="text" name="m_username" id="m_username">
            <span style="color: red;">*</span>
            <p class="p_1">請填入5~12個字元以內的小寫英文字母、數字、以及_ 符號。</p>
            </p>    
            <p>
            <strong>使用密碼:</strong>
            <input type="password" name="m_passwd" id="m_passwd">
            <span style="color: red;">*</span>
            <p class="p_1">請填入5~10個字元以內的英文字母、數字、以及各種符號組合。</p>
            </p>    
            <p>
            <strong>確認密碼:</strong>
            <input type="password" name="m_passwdcheck" id="m_passwdcheck">
            <span style="color: red;">*</span>
            <p class="p_1">再輸入一次密碼。</p>
            </p>    
            <hr>
            <h3>個人資料</h3>
            <p>
            <strong>真實姓名:</strong>
            <input type="text" name="m_name" id="m_name">
            <span style="color: red;">*</span>
            </p>    
            <p>
            <strong>性&emsp;&emsp;別:</strong>
            <input type="radio"  name="m_sex" id="m_sex" value="男" checked>男
            <input type="radio"  name="m_sex" id="m_sex" value="女">女
            <span style="color: red;">*</span>
            </p>    
            <p>
            <strong>生&emsp;&emsp;日:</strong>
            <input type="text" name="m_birthday" id="m_birthday">
            <span style="color: red;">*</span>
            <p class="p_1">格式為西元格式(YYYY-MM-DD)。</p>
            </p>    
            <strong>電子郵件:</strong>
            <input type="text" name="m_email" id="m_email">
            <span style="color: red;">*</span>
            <p class="p_1">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
            </p>    
            <p>
            <strong>個人網頁:</strong>
            <input type="text" name="m_url" id="m_url">
            <p class="p_1">請以「http://」 為開頭。</p>
            </p>   
            <p>
            <strong>電&emsp;&emsp;話:</strong>
            <input type="text" name="m_phone" id="m_phone">
            </p>   
            <p>
            <strong>住&emsp;&emsp;址:</strong>
            <input type="text" name="m_address" id="m_address">
            </p>  
            <p> <span style="color: red;">*</span> 表示為必填的欄位</p>
            <hr> 
            <p style="text-align:center">
            <input name="action" type="hidden" id="action" value="join">
            <input type="submit" name="Submit2" value="送出申請" class="input_1">
            <input type="reset" name="Submit3" value="重設資料" class="input_1">
            <input type="button" name="Submit" value="回上一頁" onclick="window.history.back();" class="input_1">
          </p> 
        </div>
        </form>
        <div class="div_2_h500">
            <h3>填寫注意事項</h3> 
            <div>
                <ol>
                <li> 請提供您本人正確、最新及完整的資料。 </li>
                <li> 在欄位後方出現「*」符號表示為必填的欄位。</li>
                <li>填寫時請您遵守各個欄位後方的補助說明。</li>
                <li>關於您的會員註冊以及其他特定資料，本系統不會向任何人出售或出借你所填寫的個人資料。</li>
                <li>在註冊成功後，除了「使用帳號」外您可以在會員專區內修改您所填寫的個人資料。</li>
                </ol>     
            </div>
        </div>
    </div>
    </div>
</body>
</html>