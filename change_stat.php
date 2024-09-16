<?php
include("funcs.php");

//1. GETデータ取得
$id   = $_GET["id"];
$end  = $_GET["end"];

//$endの値を反転
if($end == 0){
    $end = 1;
}else {
    $end = 0;
}

//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE gs_todo_table SET end=:end WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':end', $end,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("index.php");
}

?>
