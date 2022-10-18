<?php
    include 'validation.php';
    include 'member.php';
 
    $validation = new Validation();
    $member = new Member();
     
    // エラー初期化
    $error = array();
     
    if( !empty($_POST) ){
        
        $validation->setName($_POST['name']);
        $validation->setMail($_POST['email']);
        $validation->setPostal($_POST['postal']);
        $validation->setAddress($_POST['address']);
        $validation->setTel($_POST['tel']);
        $validation->setPassword($_POST['password']);
        $error = $validation->FormCheck();
        
        var_dump($error);
        
        // 入力エラーがない場合
        if( !$error['error'] ){
            $member->signin($_POST);
            header('Location: ./shop_login.php');
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
<body>
    <header class="py-4"></header>
    <nav class="navbar navbar-dark bg-dark fixed-top px-2">
        <a href="#" class="navbar-brand">market</a>
        <ul class="nav">
            <li class="nav-item">
                <a href="shop_list.php" class="nav-link">ホーム</a>
            </li>
            <li class="nav-item">
                <a href="shop_mypage.php" class="nav-link">マイページ</a>
            </li>
            <li class="nav-item">
                <a href="shop_cart.php" class="nav-link">カート</a>
            </li>
            <li class="nav-item">
            <?php
                    if(isset($_SESSION['login']) == false)
                    {
                        echo '<a class="nav-link" href="shop_login.php">ログイン</a>';
                    }
                    else
                    {
                        echo '<a class="nav-link" href="shop_logout.php">ログアウト</a>';
                    }
                ?>
            </li>
        </ul>
    </nav>
    <main>
        <div class="py-4">
            <section id="cart">
                <div class="container">
                    <h3 class="text-center">会員登録</h3>
                    <div class="row">
                        <div class="col-12 border">
                            <form method="post" action="shop_signin.php">
                                <div class="row">
                                    <div class="col-12 border">
                                        <br>
                                        お名前 <br>
                                        <input class="form-control" type="text" name="name">
                                        <?php if(isset($error['name']) && ($error['name']) == true) echo $validation::ERROR_STR01;?>
                                        <br>
                                        メールアドレス<br>
                                        <input class="form-control" type="text" name="email">
                                        <?php if(isset($error['mail']) && ($error['mail']) == true) echo $validation::ERROR_STR02;?>
                                        <br>
                                        郵便番号<br>
                                        <input class="form-control" type="text" name="postal" placeholder="000-0000">
                                        <?php if(isset($error['postal']) && ($error['postal']) == true) echo $validation::ERROR_STR04;?>
                                        <br>
                                        住所<br>
                                        <input class="form-control" type="text" name="address">
                                        <?php if(isset($error['address']) && ($error['address']) == true) echo $validation::ERROR_STR03;?>
                                        <br>
                                        電話番号<br>
                                        <input class="form-control" type="text" name="tel">
                                        <?php if(isset($error['tel']) && ($error['tel']) == true) echo $validation::ERROR_STR05;?>
                                        <br> 
                                        パスワード<br>
                                        <input type="password" class="form-control" name="password">
                                        <?php if(isset($error['password']) && ($error['password']) == true) echo $validation::ERROR_STR06;?>
                                        <br>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-warning">登録</button>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer></footer>
</body>
</html> 