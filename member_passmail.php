<?php
    require_once("connmysql.php");
    session_start();
    
    //函式：自動產生指定長度的密碼
    function MakePassword($length) { 
	$possible = "0123456789abcdefghijklmnopqrstuvwxyz"; 
	$str = ""; 
	while(strlen($str)<$length){ 
	  $str .= substr($possible, rand(0, strlen($possible)), 1); 
	}
	return($str); 
}
    //檢查是否為會員
    if(isset($_POST["account"])){
        // print "ok";
        $muser = GetSQLValueString($_POST["account"], 'string');
        //找尋該會員資料
        $sql = "SELECT `m_username`, `m_email` FROM `memberdata` WHERE `m_username`='".$muser."'";
        $result =mysqli_query($conn,$sql);
        // print $sql;
        $arr_row=mysqli_num_rows($result);
	if ($arr_row==0){
		header("Location: member_passmail.php?err=1&username=".$muser);
	}else{	
        //取出帳號密碼的值
            $arr=mysqli_fetch_assoc($result);
            $username = $arr["m_username"];
            $usermail = $arr["m_email"];	
            //產生新密碼並更新
            $newpassword = MakePassword(10);
            $mpass = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql_update = "UPDATE memberdata SET m_passwd='".$mpass."' WHERE m_username='".$username."'";
            $result_updata=mysqli_query($conn,$sql_update);
            //補寄密碼信
            $mailcontent ="親愛的會員您好，<br />您的帳號為:".$username." <br/>您的新密碼為:".$newpassword." <br/>";
            $mailFrom="=?UTF-8?B?" . base64_encode("會員管理系統") . "?= <twm0929288035@gmail.com>";
            $mailto=$usermail;
            $mailSubject="=?UTF-8?B?" . base64_encode("補寄密碼信"). "?=";
            $mailHeader="From:".$mailFrom."\r\n";
            $mailHeader.="Content-type:text/html;charset=UTF-8";
            if(!@mail($mailto,$mailSubject,$mailcontent,$mailHeader)) die("郵寄失敗!");
            header("Location: member_passmail.php?mailStats=1");
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
    <?php if(isset($_GET["mailStats"]) && ($_GET["mailStats"]=="1")){?>
    <script>alert('密碼信補寄成功!');window.location.href='index.php';</script>
    <?php }?>
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
        <?php if(isset($_GET["err"]) && ($_GET["err"]=="1")){?>
            <p class="p_2"><?php echo $_GET["username"]." 此帳號未被建立!";?></p>  
                <?php }?>
            <h3>忘記密碼?</h3>
            <form action="" method="POST">
            <div>
                <p>請輸入您申請的帳號，系統將自動產生一個十位數的密碼寄到您註冊的信箱。</p>
                <label for="">帳號:</label>
                <input type="text" name="account" id="account" >
            </div>

            <div style="margin-top: 10px;">
                <input type="submit"  value="寄密碼信" class="input_1">
                <input type="button" name="Submit" value="回上一頁" onclick="window.history.back();" class="input_1">
            </div>
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