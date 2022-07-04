<?php
    include 'session.php';
    $Session = new Session();
    $Session->CheckLogin();
    $message = '';

    if(!empty($_GET['cartin_code']))
    {
        $Session->CartIn($_GET['cartin_code']);
        $message = '商品を追加しました';
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
        <?php
        include 'class.Shop.php';

        $Product = new Product();
        $productData = $Product->getDataOnly($_GET['procode']);

        if(!empty($message))
        {
            echo $message;
        }
        ?>
        <nav class="navbar navbar-light bg-light fixed-top px-2">
            <a href="#" class="navbar-brand">market</a>
            <?php echo '<a href="shop_list.php" class="mr-sm-2">消費一覧</a>';?>
        </nav>
        <?php
            echo '<div class="card">';
            echo '<img src="../product/gazou/'.$productData['gazou'].'" alt="" style="width:100%; max-height:300px;" class="card-img-top">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title">'.$productData['name'].'</h4>';
            echo '<h6 class="card-subtitle">'.$productData['price'].' yen</h6>';
            echo '<a href="'.$_SERVER['REQUEST_URI'].'&cartin_code='.$productData['code'].'" class="btn btn-primary">カートに入れる</a>';
            echo '</div></div>';
        ?>
    </div>
    <br>
    <form>
        <a href="./shop_list.php">戻る</a>
    </form>
</body>
</html>