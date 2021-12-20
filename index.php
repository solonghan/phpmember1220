<?php
    require_once("connmysql.Php");
    session_start();
    if(isset($_SESSION['loginMember'])&& ($_SESSION['loginMember']!="")){
        if ($_SESSION['level']=='admin') {
            header("Location:member_admin.php");
        }else{
            header("Location:member_common.php");
        }
    }
    if(isset($_POST["account"]) && isset($_POST["password"]) && isset($_POST["action"]) && ($_POST["action"]=="login")){
        $sql = "SELECT `m_username`, `m_passwd`, `m_level` FROM `memberdata` WHERE `m_username`= '" .$_POST["account"]."'" ;
        $result=mysqli_query($conn,$sql);
        $arr= mysqli_fetch_assoc($result);
        $arr_row=mysqli_num_rows($result);
        mysqli_free_result($result);
        if($arr_row>0){
            //比對密碼，若登入成功則呈現登入狀態
            if(password_verify($_POST['password'],$arr['m_passwd'])){
                //計算登入次數及更新登入時間
                $sql_login_time = "UPDATE `memberdata` SET `m_login`=`m_login`+1, `m_logintime`=NOW() WHERE `m_username`='" .$_POST["account"]."'" ;
                $result_login_time=mysqli_query($conn,$sql_login_time);
                $_SESSION["loginMember"]=$arr['m_username'];
                $_SESSION["level"]=$arr['m_level'];

                //使用Cookie記錄登入資料
                if(isset($_POST["rememberme"])&&($_POST["rememberme"]=="true")){
                    setcookie("remUser", $_POST["account"], time()+365*24*60);
                    setcookie("remPass", $_POST["password"], time()+365*24*60);
                }else{
                    if(isset($_COOKIE["remUser"])){
                        setcookie("remUser", $_POST["account"], time()-100);
                        setcookie("remPass", $_POST["password"], time()-100);
                    }
                }
                    // 若帳號等級為 member 則導向會員中心
                if($_SESSION["level"]=="member"){
                    header("Location: member_common.php");
                //否則則導向管理中心
                }else{
                    header("Location: member_admin.php");	
            }
            }else{
                header("Location:index.php?err=2");
            }
        }else{
            header("Location:index.php?err=1");
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
    <title>網站會員系統</title>
</head>
<body class="body_1">
    <div style="margin:auto; width:700px">
    <h1>網站會員系統</h1>
    <div class="div_1">
   
        <div class="div_3">
        <h2>歡迎光臨網站會員系統</h2>
            <p>謝各位來到會員系統， 所有的會員功能都必須經由登入後才能使用，請您在右方視窗中執行登入動作。</p>
            <h3>本會員系統擁有以下的功能:</h3>
            <ol>
            <li>免費加入會員 。</li>
                <li>每個會員可修改本身資料。</li>
                <li>若是遺忘密碼，會員可由系統發出電子信函通知。</li>
                <li>管理者可以修改、刪除會員的資料。</li>
            </ol>
            <h3>請各位會員遵守以下規則:</h3>
            <ol>
                <li> 遵守政府的各項有關法律法規。</li>
                <li> 不得在發佈任何色情非法， 以及危害國家安全的言論。</li>
                <li>嚴禁連結有關政治， 色情， 宗教， 迷信等違法訊息。</li>
                <li> 承擔一切因您的行為而直接或間接導致的民事或刑事法律責任。</li>
                <li> 互相尊重， 遵守互聯網絡道德；嚴禁互相惡意攻擊， 漫罵。</li>
                <li> 管理員擁有一切管理權力。</li>
            </ol>
        </div>
        <div class="div_2">
            <h3>登入會員系統</h3>
            <form action="" method="POST">
            <?php if(isset($_GET["err"]) && ($_GET["err"]=="1")){?>
            <p class="p_2"><?php echo "帳號錯誤!";?></p>  
            <?php } ?>
            <?php if(isset($_GET["err"]) && ($_GET["err"]=="2")){?>
            <p class="p_2"><?php echo "密碼錯誤!";?></p>  
            <?php } ?>
            <div>
                <label for="">帳號:</label>
                <input type="text" name="account" id="account" value="<?php if(isset($_COOKIE["remUser"]) && ($_COOKIE["remUser"]!="")) echo $_COOKIE["remUser"];?>">
                <label for="">密碼:</label>
                <input type="password" name="password" id="password"value="<?php if(isset($_COOKIE["remPass"]) && ($_COOKIE["remPass"]!="")) echo $_COOKIE["remPass"];?>">
                <input type="hidden" name="action" value="login">
            </div>
                <input type="checkbox" name="rememberme" id="rememberme" value="true" checked>記住我的帳號密碼。
                <input type="submit" value="登入系統" class="input_1"> 
                <p><a href="member_passmail.php" class="a_1">忘記密碼，補寄密碼信。</a></p>
                <hr>
            <div>
                <h3>還沒有會員帳號?</h3>
                <a href="member_join.php" class="a_1">點我免費加入會員</a>
            </div>
            </form>  
        </div>
    </div>
    </div>
</body>
</html>