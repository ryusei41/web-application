<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
    $login = 'ログイン';
} else {
    $login = 'お気に入り';
    $userID = $_SESSION["userID"];
}
$dsn = 'mysql:dbname=[データベース];host=[ホスト];charsert=utf8';
$user = 'ユーザーID';
$pass = 'パスワード';
$dbh = new PDO($dsn, $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT * FROM favorite WHERE userid=?';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $userID, PDO::PARAM_STR);
$stmt->execute();
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dbh = null;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
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
<!-- お気に入り -->
    <h2 class="favo-title">お気に入り</h2>
    <?php
    for ($i = 0; $i < count($rec); $i++) {
        $id = $rec[$i]["shopid"];
        $baseurl = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
        $params = [
            'key' => '6f4ea3a230bfa237',
            'format' => 'json',
            'id' => $id
        ];
        $url = $baseurl . '?' . http_build_query($params, '', '&');
        // リクエストを送り結果を取得
        $result = file_get_contents($url);
        $arr = json_decode($result, true);
        $shop = $arr["results"]['shop'][0];
        print '<ul class="p-list">
                <li>
                    <a href="detail.php?id=' . $id . '" class="main-table">
                        <div class="p-content">
                            <div>
                                <p class="shop-photo">
                                    <img src=' . $shop["photo"]["pc"]["l"] . ' alt=' . $shop["photo"]["pc"]["l"] . '><br>
                                </p>
                            </div>
                            <table class="p-table">
                                <tr>
                                    <th class="shop-name">' . $shop["name"] . '</th>
                                </tr>
                                <tr>
                                    <td>' . $shop["genre"]["name"] . '/' . $shop["sub_genre"]["name"] . '</td>
                                </tr>
                                <tr>
                                    <td class="icon"><img src="images/open.svg">'.$shop["open"].'</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td class="icon"><img src="images/access.svg"> ' . $shop["mobile_access"] . '
                                    <td>
                                </tr>
                                <tr>
                                    <td class="icon"><img src="images/average.svg"> ' . $shop["budget"]["average"] . '
                                    <td>
                                </tr>
                            </table>
                        </div>
                    </a>
                </li>
            </ul>';
    }
    ?>
     <p class="tar"><a href="https://webservice.recruit.co.jp/"><img src="https://webservice.recruit.co.jp/banner/hotpepper-s.gif" alt="ホットペッパー Webサービス" width="135" height="17" title="ホットペッパー Webサービス"></a></p>
    <!-- フッタ -->
    <footer>
        <div class="wrapper">
            <p>
                <small>&copy;2021 Gourmet Conect</small>
            </p>
        </div>
    </footer>
</body>

</html>