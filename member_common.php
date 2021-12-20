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
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>一般會員系統</title>
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
        <div class="div_2_h260">
            <h3>一般會員系統</h3>
             <p><?php print $arr['m_name']?> ，你好。</p>
             <p>你總共登入了<?php print $arr['m_login']?> 次。</p>
             <p>本次登入時間為:</p>
             <p><?php print $arr['m_logintime']?> </p>
            <div>
                <a href='member_common_update.php?id=<?php print $arr['m_id']  ?>'  class="a_2">修改資料</a>
                <a href="?logout=true" class="a_2">登出系統</a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>