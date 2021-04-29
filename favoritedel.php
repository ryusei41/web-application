<?php
$ID=$_POST['userid'];
$shopid = $_POST['shopid'];
$dsn = 'mysql:dbname=[データベース];host=[ホスト];charsert=utf8';
$user = 'ユーザーID';
$pass = 'パスワード';
$dbh = new PDO($dsn, $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'DELETE FROM favorite WHERE userid=? AND shopid=?';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(1, $ID, PDO::PARAM_STR);
$stmt->bindParam(2, $shopid, PDO::PARAM_STR);
$stmt->execute();
$dbh = null;
exit();