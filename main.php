<?php
$lat = $_POST['lat'] ? $_POST['lat'] : '';
$lng = $_POST['lng'] ? $_POST['lng'] : '';
$range = $_POST['range'] ? $_POST['range'] : '';
$baseurl = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/';
$keyword = $_POST['keyword'] ? $_POST['keyword'] : '';
$genre = $_POST['genre'] ? $_POST['genre'] : '';
$params = [
    'key' => 'APIキー',
    'format' => 'json',
    'count' => 100,
    'lat' => $lat,
    'lng' => $lng,
    'range' => $range,
    'keyword'=>$keyword,
    'genre'=>$genre
];
$url = $baseurl . '?' . http_build_query($params, '', '&');
// リクエストを送り結果を取得
$result = file_get_contents($url);
 
// 結果を出力
header("Content-Type: text/javascript; charset=utf-8");
echo $result;
 
exit();
?>