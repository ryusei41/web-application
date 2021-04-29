<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="utf-8" />
    <title>ぐるこね</title>
    <meta name="description" content="あなたのお探しのお店がきっと見つかる！！">
    <link rel="icon" type="image/png" href="images/logo.svg">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--css-->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="http://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css">
</head>

<body>
    <div id="home" class="big-bg">
        <!-- トップページ -->
        <header class="page-header wrapper">
            <h1><a href="index.php"><img class="logo" src="images/imges.png" alt=""></a></h1>
        </header>
        <div class=" wrapper detail-nav">
            <?php
            try {
                $userID = $_POST['userID'];
                $mail = $_POST['mail'];
                $password = $_POST['password'];
                $userID = htmlspecialchars($userID, ENT_QUOTES, 'UTF-8');
                $mail = htmlspecialchars($mail, ENT_QUOTES, 'UTF-8');
                $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
                $dsn = 'mysql:dbname=[データベース];host=[ホスト];charsert=utf8';
                $user = 'ユーザーID';
                $pass = 'パスワード';
                $dbh = new PDO($dsn, $user, $pass);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'INSERT INTO login(userID,mail,password) VALUES(?,?,?)';
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(1, $userID, PDO::PARAM_STR);
                $stmt->bindParam(2, $mail, PDO::PARAM_STR);
                $stmt->bindParam(3, $password, PDO::PARAM_STR);
                $stmt->execute();
                $dbh = null;
                print $userID;
                print 'さんを追加しました。';
                print '<a href="login.php">ログインページへ</a>';
            } catch (Exception $e) {
                print $e;
                echo 'ただいま工事中です';
                print '<input class="button type="button" onclick="history.back()" value="戻る" />';
            } ?>
        </div>
    </div>
</body>

</html>