<?php
    session_start();
    if(!isset($_SESSION['code']) === false)
    {
        header('Location: ./root_top.php');
    }

    include 'validation.php';
    include 'dbconnect.php';
 
    $validation = new Validation();
    $dbConnecter = new DB();
     
    // エラー初期化
    $error = array();
     
    if( !empty($_POST) ){
        
        $validation->setCode($_POST['code']);
        $validation->setPassword($_POST['password']);
        $error = $validation->staffCheck();
        
        // 入力エラーがない場合
        if( !$error['error'] ){
            $test = $dbConnecter->staffLogin($_POST);
        } 
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body style="padding-top:70px;">
    <div class="container">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <a href="#" class="navbar-brand">管理者サイト</a>
        </nav>
        <h2>スタッフログインページ</h2>
        <form method="post" action="root_login.php">
            <div class="form-group">
                <label for="code">スタッフコード</label>
                <input type="text" class="form-control" name="code" id="code">
                <?php if(isset($error['code']) && ($error['code']) == true) echo $validation::ERROR_STR07;?>
            </div>
            <div class="form-group">
                <label for="">パスワード</label>
                <input type="password" class="form-control" name="password">
                <?php if(isset($error['password']) && ($error['password']) == true) echo $validation::ERROR_STR06;?>
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
    </div>
</body>
</html> 