<?php
    session_start();
    if(isset($_SESSION['code']) === false)
    {
        header('Location: ./root_login.php');
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
        <h2>商品リスト</h2>
        <form method="post" action="pro_branch.php">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>値段</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                         include './dbconnect.php';

                         $product = new DB();
                         $productData = $product->getProduct();
 
                         foreach($productData as $product) {
                             echo '<tr>';
                             echo '<td>'.$product['code'].'</td>';
                             echo '<td>'.$product['name'].'</td>';
                             echo '<td>'.$product['price'].'</td>';
                             echo '<td><a class="btn btn-primary" href ="./root_product.php?code='.$product['code'].'">詳細</a></td>';
                             echo '</tr>';
                         }
                    ?>
                </tbody>
            </table>
        </form>

        <a href="./root_top.php">トップメニュー</a>
    </div>

</body>
</html>
