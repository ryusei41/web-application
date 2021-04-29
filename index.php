<?php
session_start();
session_regenerate_id(true);
$name = '';
if (isset($_SESSION['login']) == false) {
    $login = 'ログイン';
    // exit();
} else {
    $login = 'お気に入り';
    $name = $_SESSION['userID'];
}
?>
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
    <div id=app>
        <div id="home" class="big-bg">
            <!-- トップページ -->
            <header class="page-header wrapper">
                <h1><a href="index.php"><img class="logo" src="images/imges.png" alt=""></a></h1>
                <nav>
                    <div class='main-nav'>
                        <input type="text" name="gourmet_keyword" placeholder="　店名、 地名、駅名など　" v-model="keyword" @input="getGourmet" />
                        <?php if ($login == "ログイン") {
                            echo "<a href='login.php'>$login</a>";
                        } else {
                            echo "<a href='favorite_page.php'>$login</a>";
                        }
                        ?>
                    </div>
                </nav>
            </header>
            <div class=" home-content wrapper">
                <h2 class="page-title">Welcome <?php echo $name ?></h2>

                <p class="sub-title">あなたのお探しのお店がきっと見つかる</p>
                <div>
                    <div>
                        <a class="button" @click="getGeo">現在地を取得</a>
                        <p class="range" v-show="geoActive"><select name="range range2" v-model="range" @change="getGourmet" required>
                                <option value="" hidden>1000m</option>
                                <option value="1">300m圏内</option>
                                <option value="2">500m圏内</option>
                                <option value="3" selected>1000m圏内</option>
                                <option value="4">2000m圏内</option>
                                <option value="5">3000m圏内</option>
                            </select></p>
                    </div>
                </div>
            </div>

        </div>
        <!-- ジャンル -->
        <div id="genre" class="autoplay">
            <a v-on:click="getgenre('G001')"><img src="images/G001.jpg">
                <p>居酒屋</p>
            </a>
            <a v-on:click="getgenre('G004')"><img src="images/G004.jpg">
                <p>和食</p>
            </a>
            <a v-on:click="getgenre('G005')"><img src="images/G005.jpg">
                <p>洋食</p>
            </a>
            <a v-on:click="getgenre('G007')"><img src="images/G007.jpg">
                <p>中華</p>
            </a>
            <a v-on:click="getgenre('G008')"><img src="images/G008.jpg">
                <p>焼肉</p>
            </a>
            <a v-on:click="getgenre('G013')"><img src="images/G013.jpg">
                <p>ラーメン</p>
            </a>
            <a v-on:click="getgenre('G014')"><img src="images/G014.jpg">
                <p>スイーツ</p>
            </a>
        </div>
        <div class="p-result-area" v-if="gourmetList.length > 0">
            <p class="count">{{ gourmetCount }}件表示中</p>
            <ul class="p-list">
                <li v-for="item of gourmetList">
                    <a :href="item.shop_url" class="main-table">
                        <div class="p-content">
                            <div>
                                <p class="shop-photo">
                                    <img :src="item.photo" :alt="item.name"><br>
                                </p>
                            </div>
                            <table class="p-table">
                                <tr>
                                    <th class="shop-name">{{ item.name }}</th>
                                </tr>
                                <tr>
                                    <td>{{ item.category }}/{{item.subcategory}}</td>
                                </tr>
                                <tr>
                                    <td class="icon"><img src="images/open.svg">{{item.open}}</td>
                                </tr>
                                <tr>
                                    <td class="icon"><img src="images/access.svg"> {{ item.access }}
                                    <td>
                                </tr>
                                <tr>
                                    <td class="icon"><img src="images/average.svg"> {{ item.average }}
                                    <td>
                                </tr>
                                <tr>
                                </tr>
                            </table>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div id="back-to-top"><a href="#">page up</a></div>
        <p class="tar"><a href="https://webservice.recruit.co.jp/"><img src="https://webservice.recruit.co.jp/banner/hotpepper-s.gif" alt="ホットペッパー Webサービス" width="135" height="17" title="ホットペッパー Webサービス"></a></p>
    </div>
    <!-- javascript -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src=" https://unpkg.com/axios/dist/axios.min.js "> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/vue.js"></script>
    <script type="text/javascript">
        $('.autoplay').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
        });
    </script>
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