<?php
session_start();
session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
<script src=" https://code.jquery.com/jquery-3.4.1.min.js "></script>
<script src="../js/user_page.js"></script>
</head>
<body>

<?php
require_once('../config.php');

try
{

$pro_code=$_GET['procode'];

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name,address,time_start,time_end,gazou FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec = $stmt -> fetch(PDO::FETCH_ASSOC);
$pro_name = $rec['name'];
$pro_address = $rec['address'];
$pro_time_start = $rec['time_start'];
$pro_time_end = $rec['time_end'];
$pro_gazou_name =$rec['gazou'];

$dbh = null;

if($pro_gazou_name=='')
{
    $disp_gazou='';
}
else
{
    $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
}

}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>

詳細投稿情報<br />
<br />
投稿番号<br />
<?php print $pro_code; ?>
<br />
<br />
店名<br />
<?php print $pro_name;?>
<br />
住所<br />
<?php print $pro_address;?>
<br />
画像<br />
<?php print '<img src="./gazou/'.$pro_gazou_name.'" style="width:200px">';?><br />
営業時間<br />
<?php print $pro_time_start;?>時
~
<?php print $pro_time_end;?>時
<br />
<?php print '<a href="../product/pro_edit.php?procode='.$pro_code.'">編集</a><br />';?>
<?php print '<a href="../product/pro_delete.php?procode='.$pro_code.'">削除</a><br />';?>
      <!-- お気に入りボタン ahaxで処理-->
      <form class="favorite_count" action="#" method="post">
        <input type="hidden" name="post_id" value="<?= $pro_code ?>">
        <button type="button" name="favorite" class="favorite_btn">
        <!-- 登録済みか判定してアイコンを変える -->
        <?php if (!check_favolite_duplicate($_SESSION['staff_code'],$pro_code)): ?>
          いいね
        <?php else: ?>
          いいね解除
        <?php endif; ?>
        </button>
        <span class="post_count"><?= current(get_post_favorite_count($pro_code)) ?></span>
        <!-- currentは引数に入っている配列の現在の値を渡す -->
</form>
<br />
<br />
<form>
<input type="button" onclick="history.back()"value="戻る"> 
</form>
</body>
</html>