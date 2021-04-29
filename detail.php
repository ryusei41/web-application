<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
  $login = 'ログイン';
} else {
  $login = 'お気に入り';
  $userID = $_SESSION["userID"];
}
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}
$baseurl = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';

$params = [
  'key' => 'APIキー',
  'format' => 'json',
  'id' => $id
];
$url = $baseurl . '?' . http_build_query($params, '', '&');
// リクエストを送り結果を取得
$result = file_get_contents($url);
$arr = json_decode($result, true);
$shop = $arr["results"]['shop'][0];
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
  <div id="home" class="big-bg">
    <!-- トップページ -->
    <header class="page-header wrapper">
      <h1><a href="index.php"><img class="logo" src="images/imges.png" alt=""></a></h1>
      <nav>
        <div class='main-nav'>
          <?php if ($login == "ログイン") {
            echo "<a href='login.php'>$login</a>";
          } else {
            echo "<a href='favorite_page.php'>$login</a>";
          }
          ?>
        </div>
      </nav>
    </header>
    <div class="shop-logo"><img src="<?php echo $shop["logo_image"] ?>">
      <p class="shop-name"><?php echo $shop["name"] ?></p>
      <p class="catch"><?php echo $shop["genre"]["catch"] ?></p>
    </div>
    <!-- 詳細情報 -->
    <div class="wrapper detail-nav">
      <div class="detail-flex">
        <div>
          <p class="shop-photo">
            <img src="<?php echo $shop["photo"]["pc"]["l"]  ?>"><br>
          </p>
        </div>
        <table class="p-table">
          <tr>
            <td>＜詳細情報＞</td>
          </tr>
          <tr>
            <td><?php echo $shop["genre"]["name"] ?>/<?php echo $shop["sub_genre"]["name"] ?></td>
          </tr>
          <tr>
            <td class="icon"><img src="images/open.svg"><?php echo $shop["open"]?></td>
          <tr>
          <tr>
            <td class="icon"><img src="images/access.svg"><?php echo $shop["access"]?></td>
          </tr>
          
          <tr>
            <td class="icon"><img src="images/address.svg"><?php echo $shop["address"]?></td>
          </tr>
          <tr>
            <td class="icon"><a href='https://maps.google.co.jp/maps?q=<?php echo $shop["name"] ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Google マップで見る</a></td>
          </tr>
        
            <td class="icon"><img src="images/average.svg"><?php echo $shop["budget"]["average"] ?></td>
          </tr>
          <tr>
            <td class="icon"><img src="images/card.svg" ><?php echo $shop["card"]?></td>
        </tr>
          <tr>
            <td class="icon"><img src="images/non_smoking.svg"><?php echo $shop["non_smoking"]?></td>
        </tr>
          <tr>
            <td class="icon"><img src="images/coupon.svg" href="<?php echo $shop["coupon_urls"]["pc"]?>">クーポン</td>
        </tr>
          <tr>
            <td class="icon"><img src="images/wifi.svg"><?php echo $shop["wifi"]?></td>
        </tr>
          <tr>
            <td class="icon"><img src="images/parking.svg"><?php echo $shop["parking"]?></td>
        </tr>
          <?php
          if ($login == 'お気に入り') {
            $dsn = 'mysql:dbname=practice;host=localhost;charsert=utf8';
            $user = 'root';
            $pass = 'root';
            $dbh = new PDO($dsn, $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM favorite WHERE userid =? AND shopid=?";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(1, $userID, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_STR);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $dbh = null;
            if ($rec == false) {
              print '<p><a  data-condition=false class="favoButton favocolor" data-userid=' . $userID . ' data-shopid=' . $id . '>★</a></p>';
            } else {
              print '<p><a  data-condition=true class="favoButton favocolor_2 favocolor" data-userid=' . $userID . ' data-shopid=' . $id . '>★</a></p>';
            }
          }
          ?>
        </table>
      </div>
    </div>
  </div>

  </div>
  <p class="tar"><a href="https://webservice.recruit.co.jp/"><img src="https://webservice.recruit.co.jp/banner/hotpepper-s.gif" alt="ホットペッパー Webサービス" width="135" height="17" title="ホットペッパー Webサービス"></a></p>
    <footer>
    <!-- フッタ -->
        <div class="wrapper">
            <p>
                <small>&copy;2021 Gourmet Conect</small>
            </p>
        </div>
    </footer>
</body>
<!-- javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/main.js"></script>

</html>