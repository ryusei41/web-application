<!-- パスワード暗号化 -->
<?php
$userID = $_POST['userID'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$userID = htmlspecialchars($userID, ENT_QUOTES, 'UTF-8');
$mail = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
$repassword = htmlspecialchars($repassword, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="utf-8" />
    <title>ぐるこね</title>
    <meta name="description" content="あなたのお探しのお店がきっと見つかる！！">
    <link rel="icon" type="image/png" href="images/logo.svg">
    <!--css-->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="http://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
</head>
<div id="home" class="big-bg">
    <header class="page-header wrapper">
        <h1><a href="index.php"><img class="logo" src="images/imges.png" alt=""></a></h1>
    </header>
    <!-- 入力確認 -->
    <div class=" wrapper detail-nav">
        <?php
        if ($userID == '' || $mail == '' || $password == '' || $password != $repassword) {
            print '入力が正しくありません。<br />';
            print '<form><input_type =“button" onclick=“history.back()" value=“戻る
"></input_type></form>';
        } else {
            print "<p>ユーザーID：" . $userID . '</p>';
            print "<p>メールアドレス：" . $mail . '</p>';
            print "<p>パスワード：" . $password . '</p>';
            $salt = hash('SHA256', 'gaerfa;dfag');
            $password = hash('SHA256', $password . $salt);
            print '<form method="post" action="new_3.php">';
            print '<input type="hidden" name="userID" value="' . $userID . '"/>';
            print '<input type="hidden" name="mail" value="' . $mail . '"/>';
            print '<input type="hidden" name="password" value="' . $password . '" />';
            print '<input class="button" type="button" onclick="history.back()" value="戻る" />';
            print '<input class="button" type="submit" value="OK" />';
            print '</form>';
        }
        ?>
    </div>
</div>

</html>