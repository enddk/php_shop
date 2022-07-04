<?php
    include 'session.php';
    $Session = new Session();
    $Session->CheckLogin();

    if(!empty($_GET))
    {
        $Session->CartIn($_GET['product']);
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
            <?php echo '<a href="shop_cartlook.php" class="mr-sm-2">買い物かご</a>';?>
        </nav>
        <h3 class="text-center">product list</h3>
        
        <?php
            include 'class.Shop.php';

            $Product = new Product();
            $productData = $Product->getData();
            echo '<div class="row">';
                for($i = 0; $i < count($productData); $i++)
                {
                    echo '<div class="card col-4">';
                    echo '<img src="../product/gazou/'.$productData[$i]['gazou'].'" alt="" class="card-img-top">';
                    echo '<div class="card-body">';
                    echo '<h4 class="card-title">'.$productData[$i]['name'].'</h4>';
                    echo '<h6 class="card-subtitle">'.$productData[$i]['price'].' yen</h6>';
                    echo '<a href="shop_product.php?procode='.$productData[$i]['code'].'" class="btn btn-primary">商品を見る</a>';
                    echo '</div></div>';
                }
        ?>
    </div>
</body>
</html>