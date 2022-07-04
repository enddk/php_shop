<?php
    include 'class.Shop.php';
    include 'session.php';
 
    $Product = new Product();
    $Session = new Session();
     
    // エラー初期化
    $error = array();
     
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
        
        $Product->setName($_POST['name']);
        $Product->setMail($_POST['email']);
        $Product->setPostal($_POST['postal']);
        $Product->setAddress($_POST['address']);
        $Product->setTel($_POST['tel']);
        $error = $Product->FormCheck();
        
        // 入力エラーがない場合
        if( !$error['error'] ){
            $Product->insertBuyData($_POST, $Session);
            echo '登録が完了しました';
            echo '<a href="shop_list.php">top</a>';
            exit();
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
<body style="padding-top:50px;">
    <div class="container">
        <nav class="navbar navbar-light bg-light fixed-top px-2">
            <a href="#" class="navbar-brand">market</a>
            <?php echo '<a href="shop_list.php" class="mr-sm-2">product list</a>';?>
        </nav>
        customer info<br>
        <form method="post" action="shop_form.php">
            name <br>
            <input class="form-control" type="text" name="name">
            <?php if(isset($error['name'])) echo $Product::ERROR_STR01;?>
            <br>
            <br>
            mailaddress <br>
            <input class="form-control" type="text" name="email">
            <?php if(isset($error['mail'])) echo $Product::ERROR_STR02;?>
            <br>
            <br>
            postal code <br>
            <input class="form-control" type="text" name="postal" placeholder="000-0000">
            <?php if(isset($error['postal'])) echo $Product::ERROR_STR03;?>
            <br>
            <br>
            address <br>
            <input class="form-control" type="text" name="address">
            <?php if(isset($error['address'])) echo $Product::ERROR_STR04;?>
            <br>
            <br>
            tel number <br>
            <input class="form-control" type="text" name="tel">
            <?php if(isset($error['tel'])) echo $Product::ERROR_STR05;?>
            <br>
            <br>
            <input class="btn btn-danger" type="button" onclick="history.back()" value="back">
            <input class="btn btn-primary" type="submit" value="ok"><br>
        </form>
    </div>
</body>
</html>