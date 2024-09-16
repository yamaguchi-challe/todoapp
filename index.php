<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_todo_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);
// ajaxでもできる

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>todoアプリ</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="insert_view.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
      <table>
        <tr>
          <th></th>
          <th>TODO</th>
          <th></th>
          <th></th>
        </tr>
        <?php foreach($values as $v){ ?>
          <tr>
          <!-- <form method="POST" action="update.php"> -->
          <td class="check">
            <?php if($v["end"] == 0):?>
              <a href="change_stat.php?id=<?=h($v["id"])?>&end=<?=h($v["end"])?>" class="button-30">　</a>
            <?php else:?>
              <a href="change_stat.php?id=<?=h($v["id"])?>&end=<?=h($v["end"])?>" class="button-30">☑</a>
            <?php endif; ?>
          </td>
          <td class="todo"><?=h($v["todo"])?></td>
          <td class="button-1"><a href="detail.php?id=<?=h($v["id"])?>">更新</a></td>
          <td class="button-1"><a href="delete.php?id=<?=h($v["id"])?>">削除</a></td>
        <!-- </form> -->
        </tr>
      <?php } ?>
      </table>

  </div>
</div>
<!-- Main[End] -->

<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));
</script>
</body>
</html>
