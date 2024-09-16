<?php

include("funcs.php");

//1. POSTデータ取得
$todo   = $_POST["todo"];
$end = 0;
$prim = 1;


//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_todo_table(todo,end,prim)VALUES(:todo,:end,:prim)");
$stmt->bindValue(':todo',   $todo,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':end',  $end,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':prim',    $prim,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("index.php");
}

