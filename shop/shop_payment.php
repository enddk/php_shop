<?php
    include 'validation.php';
    include 'cart.php';
 
    $validation = new Validation();
    $cart = new Cart();
     
    // エラー初期化
    $error = array();
     
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        
        $validation->setName($_POST['name']);
        $validation->setMail($_POST['email']);
        $validation->setPostal($_POST['postal']);
        $validation->setAddress($_POST['address']);
        $validation->setTel($_POST['tel']);
        $error = $validation->FormCheck();
        
        // 入力エラーがない場合
        if( !$error['error'] ){
            $cart->cartReset();
            header('Location: ./shop_payment_done.php');
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">
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
                    <form method="post" action="shop_payment.php">
                        <div class="row">
                            <div class="col-7 border">
                                <br>
                                お名前 <br>
                                <input class="form-control" type="text" name="name">
                                <?php if(isset($error['name'])) echo $validation::ERROR_STR01;?>
                                <br>
                                メールアドレス<br>
                                <input class="form-control" type="text" name="email">
                                <?php if(isset($error['mail'])) echo $validation::ERROR_STR02;?>
                                <br>
                                郵便番号<br>
                                <input class="form-control" type="text" name="postal" placeholder="000-0000">
                                <?php if(isset($error['postal'])) echo $validation::ERROR_STR04;?>
                                <br>
                                住所<br>
                                <input class="form-control" type="text" name="address">
                                <?php if(isset($error['address'])) echo $validation::ERROR_STR03;?>
                                <br>
                                電話番号<br>
                                <input class="form-control" type="text" name="tel">
                                <?php if(isset($error['tel'])) echo $validation::ERROR_STR05;?>
                                <br>
                            </div>
                            <div class="col-5 border">
                                <div class="card">
                                    <div class="card-body d-grid gap-2">
                                        <?php
                                            include 'product.php';

                                            $Product = new Product();
                                            $productData = $Product->getCart($cart);
                                        ?>
                                        <h4 class="card-title">合計:<?php echo $productData['sum'];?>円</h4>
                                        <button type="submit" class="btn btn-warning">注文を確定する</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
    <footer></footer>
</body>
</html>