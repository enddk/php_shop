<?php
    include 'session.php';
    $Session = new Session();
    $Session->CheckLogin();

    if(!empty($_POST))
    {
        $Session->kazu_change($_POST);
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
            <?php echo '<a href="shop_list.php" class="mr-sm-2">商品一覧</a>';?>
        </nav>
    <?php
        include 'class.Shop.php';

        $Product = new Product();
        $productData = $Product->getCart($Session);
        $gokei = 0;
    ?>
        <form method="post" action="shop_cartlook.php">
            <table class="table">
                <tr>
                    <td>商品名</td>
                    <td>画像</td>
                    <td>値段</td>
                    <td>個数</td>
                    <td>小計</td>
                    <td>削除</td>
                </tr>
                <?php for($i = 0; $i < ($productData['max']); $i++){?>
                    <tr>
                        <td><?php echo $productData['name'][$i];?></td>
                        <td><?php echo $productData['gazou'][$i];?></td>
                        <td><?php echo $productData['price'][$i].' yen';?></td>
                        <td><?php echo '<input type="number" name="kazu'.$i.'" value="'.$productData['kazu'][$i].'">';?></td>
                        <td><?php echo $productData['price'][$i] * $productData['kazu'][$i].' yen';?></td>
                        <?php $gokei += $productData['price'][$i] * $productData['kazu'][$i];?>
                        <td><?php echo '<input type="checkbox" name="sakujyo'.$i.'">';?></td>
                        <br>
                    </tr>
                <?php }?> 
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>合計</td>
                    <td><?php echo $gokei,' yen'?></td>
                    <td></td>
                </tr>   
            </table>

            <input type="hidden" name="max" value="<?php echo $productData['max'];?>">
            <?php if($productData['max'] != 0){ echo '<input type="submit" value="個数変更">';}?>
            <br>
            <br>
            <a href="shop_list.php">一覧へ戻る</a>
        </form>
        <a href="shop_form.php">会計へ進む</a>
    </div>
</body>
</html>