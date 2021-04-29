<?php
try {
    $userID = $_POST['userID'];
    $password = $_POST['password'];
    $userID = htmlspecialchars($userID, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
    $salt = hash('SHA256', 'gaerfa;dfag');
    $password = hash('SHA256', $password . $salt);
    $dsn = 'mysql:host=[ホスト];dbname=[データベース];charset=utf8';
    $user = 'ユーザーID';
    $pass = 'パスワード';
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM `login` WHERE password=? AND userID=?;';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $password, PDO::PARAM_STR);
    $stmt->bindParam(2, $userID, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
?>
    <!DOCTYPE html>

    <html lang="ja">

    <head>
        <meta charset="utf-8" />
        <title>ぐるこね</title>
        <meta name="description" content="あなたのお探しのお店がきっと見つかる！！">
        <!--css-->
        <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
        <link href="http://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="images/logo.svg">
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
            while (true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec == false) {
                    print '<p>IDまたはパスワードが誤っています</p>';
                    print '<a href="login.php">戻る</a>';
                    break;
                } else {
                    print '<h3>ようこそ' . $rec['userID'] . '</h3>';
                    session_start();
                    session_regenerate_id(true);
                    $_SESSION['login'] = 1;
                    $_SESSION['userID'] = $userID;
                    print '<a href="index.php">マイページに移動</a>';
                    break;
                }
            }
        } catch (Exception $e) {
            echo $e;
            echo 'ただいま工事中です';
            exit();
        }
            ?>
            </div>
        </div>
    </body>

    </html>