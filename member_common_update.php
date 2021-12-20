<?php
  require_once("connmysql.php");
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
    //執行修改更新動作
    if(isset($_POST["action"])&&($_POST["action"]=="update")){
        //判斷輸入密碼是否修改
            $final_passwd=$_POST['m_passwd_hidden'];
            if(($_POST["m_passwd"]!="")&&($_POST["m_passwd"]==$_POST["m_passwdcheck"])){
                $final_passwd = password_hash($_POST["m_passwd"], PASSWORD_DEFAULT);
            }

            $sql_update ="UPDATE `memberdata` SET ";
            $sql_update.="`m_passwd`='" . $final_passwd . "',";
            $sql_update.="`m_name`='". GetSQLValueString($_POST['m_name'],'string') ."',";
            $sql_update.="`m_sex`='" . GetSQLValueString($_POST['m_sex'],'string') ."',";
            $sql_update.="`m_birthday`='" . GetSQLValueString($_POST['m_birthday'],'string') ."',";
            $sql_update.="`m_email`='" . GetSQLValueString($_POST['m_email'],'email') ."',";
            $sql_update.="`m_url`='" . GetSQLValueString($_POST['m_url'],'url') ."',";
            $sql_update.="`m_phone`='" . GetSQLValueString($_POST['m_phone'],'int') ."',";
            $sql_update.="`m_address`='" . GetSQLValueString($_POST['m_address'],'string') ."'";
            $sql_update.=" WHERE `m_id`=" . $_POST["m_id"];
            print $sql_update;
            mysqli_query($conn,$sql_update);
            mysqli_close($conn);
            header("Location:member_common.php");
                
        }
    $sql = "SELECT * FROM `memberdata` WHERE `m_id`=" . $_GET["id"];
    $result = mysqli_query($conn,$sql);
    $arr = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
    <script language="javascript" src="script_update.js"></script>
</head>
<body class="body_1">
    <div style="margin:auto; width:700px">
    <h1>網站會員系統</h1>
    <div class="div_1">
    <form action="" method="POST" name="formJoin" id="formJoin" onsubmit="return checkForm();">
        <div class="div_3">
            <h2>會員資料修改</h2>
            <hr>
            <?php if(isset($_GET["err"]) && ($_GET["err"]=="1")){?>
            <p><?php echo $_GET["username"];?></p>  
                <?php }?>
            <h3>帳號資料</h3>
            <p>
            <strong>使用帳號:</strong>
            <span><?php print $arr["m_username"];  ?></span>
            </p>    
            <p>
            <strong>使用密碼:</strong>
            <input type="password" name="m_passwd" id="m_passwd">
            <input type="hidden" name="m_passwd_hidden" id="m_passwd_hidden" value="<?php print $arr["m_passwd"];?>">
            </p>    
            <p>
            <strong>確認密碼:</strong>
            <input type="password" name="m_passwdcheck" id="m_passwdcheck">
            </p>    
            <p class="p_1">若不修改密碼，請不要填寫。若要修改，請輸入密碼二次。</p>  
            <hr>
            <h3>個人資料</h3>
            <p>
            <strong>真實姓名:</strong>
            <input type="text" name="m_name" id="m_name" value="<?php print $arr["m_name"];?>">
            <span style="color: red;">*</span>
            </p>    
            <p>
            <strong>性&emsp;&emsp;別:</strong>
            <input type="radio"  name="m_sex" id="m_sex" value="男" <?php if($arr["m_sex"]=="男") print "checked";?>>男
            <input type="radio"  name="m_sex" id="m_sex" value="女" <?php if($arr["m_sex"]=="女") print "checked";?>>女
            <span style="color: red;">*</span>
            </p>    
            <p>
            <strong>生&emsp;&emsp;日:</strong>
            <input type="text" name="m_birthday" id="m_birthday" value="<?php print $arr["m_birthday"];?>">
            <span style="color: red;">*</span>
            <p class="p_1">格式為西元格式(YYYY-MM-DD)。</p>
            </p>    
            <strong>電子郵件:</strong>
            <input type="text" name="m_email" id="m_email" value="<?php print $arr["m_email"];?>">
            <span style="color: red;">*</span>
            </p>    
            <p>
            <strong>個人網頁:</strong>
            <input type="text" name="m_url" id="m_url" value="<?php print $arr["m_url"];?>">
            <p class="p_1">請以「http://」 為開頭。</p>
            </p>   
            <p>
            <strong>電&emsp;&emsp;話:</strong>
            <input type="text" name="m_phone" id="m_phone" value="<?php print $arr["m_phone"];?>">
            </p>   
            <p>
            <strong>住&emsp;&emsp;址:</strong>
            <input type="text" name="m_address" id="m_address" value="<?php print $arr["m_address"];?>">
            </p>   
            <p> <span style="color: red;">*</span> 表示為必填的欄位</p>
            <hr>
            <p style="text-align:center">
            <input name="action" type="hidden" id="action" value="update">
            <input type="hidden" name="m_id" value="<?php print $arr["m_id"];?>">
            <input type="submit" name="Submit2" value="更新資料" class="input_1">
            <input type="reset" name="Submit3" value="恢復資料" class="input_1">
            <input type="button" name="Submit" value="回上一頁" onclick="window.history.back();" class="input_1">
          </p> 
        </div>
        </form>
        <div class="div_2_h260">
            <h3>一般會員系統</h3>
             <p><?php print $arr['m_name']?> ，你好。</p>
             <p>你總共登入了<?php print $arr['m_login']?> 次。</p>
             <p>本次登入時間為:</p>
             <p><?php print $arr['m_logintime']?> </p>
            <div>
                <a href="member_common.php" class="a_2">會員中心</a>
                <a href="?logout=true" class="a_2">登出系統</a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>