<?php
    include 'cart.php';
    $cart = new Cart();

    $message = '';

    if(!empty($_GET['cartin_code']))
    {
        $cart->CartIn($_GET['cartin_code']);
        
        $message = '商品を追加しました';
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
                    <?php
                        if(!empty($message))
                        {
                            echo '<p class="text-center">'.$message.'</p>';

                        }
                    ?>
                    
                    <div class="row">
                        <?php
                            include 'product.php';

                            $Product = new Product();
                            $productData = $Product->getDataOnly($_GET['procode']);

                            echo '<div class="col-7 border">
                                    <img src="../../product/gazou/'.$productData['gazou'].'" alt="" style="width:100%; height:200px;">
                                </div>';
                            echo '<div class="col-5 border">
                                    <div class="card">
                                        <div class="card-body d-grid gap-2">
                                            <h4>'.$productData['name'].'</h4>
                                            <h6 class="card-subtitle">'.$productData['price'].' 円</h6>
                                            <a href="shop_product.php?procode='.$productData['code'].'&cartin_code='.$productData['code'].'" class="btn btn-primary">カートに入れる</a>
                                        </div>
                                    </div>
                                </div>';
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer></footer>
</body>
</html>