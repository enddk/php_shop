<?php
    include 'cart.php';
    $cart = new Cart();

    if(!empty($_POST))
    {
        $cart->CartChange($_POST);
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
                    <div class="row">
                        <div class="col-7 border">
                            <form method="post" action="shop_cart.php">
                                <div class="row">
                                    <?php
                                        include 'product.php';

                                        $Product = new Product();
                                        $productData = $Product->getCart($cart);
                                    ?>
                                    <?php for($i = 0; $i < ($productData['max']); $i++){?>
                                        <div class="col-3 border">
                                            <?php echo $productData['gazou'][$i];?>
                                        </div>
                                        <div class="col-9 border">
                                            <h5><?php echo $productData['name'][$i];?></h5>
                                            <p><?php echo $productData['price'][$i] * $productData['kazu'][$i].' 円';?></p>
                                            <?php echo '<input type="number" name="kazu'.$i.'" value="'.$productData['kazu'][$i].'">';?>
                                            <br>
                                            削除<?php echo '<input type="checkbox" name="sakujyo'.$i.'">';?>
                                        </div>
                                    <?php }?> 
                                    <input type="hidden" name="max" value="<?php echo $productData['max'];?>">
                                    <?php if($productData['max'] != 0){ echo '<input type="submit" value="個数変更" class="btn btn-primary">';}?>
                                </div>
                            </form>
                        </div>
                        <div class="col-5 border">
                            <div class="card">
                                <div class="card-body d-grid gap-2">
                                    <h4 class="card-title">合計：<?php echo $productData['sum'],' 円'?></h4>
                                    <?php if(!$productData['max'] == 0) {?>
                                    <a href="shop_payment.php" class="btn btn-warning">会計へ進む</a>
                                    <?php }?>
                                    <a href="shop_list.php" class="btn btn-primary">買い物を続ける</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer></footer>
</body>
</html>