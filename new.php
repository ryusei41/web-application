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

<body>
<div id="home" class="big-bg">
          <!-- 新規入会 -->
            <header class="page-header wrapper ">
                <h1><a href="index.php"><img class="logo" src="images/imges.png" alt=""></a></h1>
            </header>
            <div class=" wrapper detail-nav">
        <h1>ユーザの追加</h1>
        <form method="post" action="3-5-7.php">
            メールアドレスを入力してください<br />
            <input type="email" name="mail"/><br />
            ユーザーID（半角英数字）を入力してください<br />
            <input type="text" name="userID"/><br />
            パスワードを入力してください<br />
            <input type="password" name="password"/><br />
            もう一度パスワードを入力してください<br />
            <input type="password" name="repassword"/><br />
            <input class="button" type="button" onclick="history.back()" value="戻る" />
            <input class="button" type="submit" value="OK" />
        </form>
        </div>
</div>

</body>

</html>