<?php
    session_start();
    if(isset($_SESSION['code']) === false)
    {
        header('Location: ./root_login.php');
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
        <a href="#" class="navbar-brand">管理者サイト</a>
    </nav>
    <main>
        <div class="py-4">
            <section id="cart">
                <div class="container">
                    <?php
                       //編集しましたのコメント
                    ?>
                    
                    <div class="row">
                    <div class="col-12 border">
                            <form method="post" action="shop_mypage.php">
                                <?php
                                    //商品情報を一つ取得
                                    include './dbconnect.php';

                                    $product = new DB();
                                    $productData = $product->getProductOnly($_GET['code']);
                                ?>
                                <br>
                                <div class="text-center">
                                    <img src="../../product/gazou/<?php echo $productData[0]['gazou'];?>" alt="" style="width:300px; height:300px;">
                                </div>
                                商品名 <br>
                                <input class="form-control" type="text" name="name" value="<?php echo $productData[0]['name'];?>">
                                
                                <br>
                                値段<br>
                                <input class="form-control" type="text" name="price" value="<?php echo $productData[0]['price'];?>">
                                
                                <br>
                                画像<br>
                                <input type="file" src="" alt="" class="form-control-file">
                                
                                <input type="hidden" name="code" value="<?php echo $productData[0]['code'];?>">
                                <div class="text-center">
                                    <button class="btn btn-primary">編集する</button>
                                    <a href="product_delete.php?code=" class="btn btn-danger">削除する</a>
                                </div>
                                <br>
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