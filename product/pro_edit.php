<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login']) == false)
    {
        echo 'not login <br>';
        echo '<a href="../staff_login/staff_login.php">login page</a>';
        exit();
    }
    else
    {
        echo $_SESSION['staff_name'].' is login<br><br>';
    }
?>
<?php
    try
    {
        $pro_code = $_GET['procode'];

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT name, price, gazou FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];
        $pro_gazou_old = $rec['gazou'];

        $dbh = null;
    }
    catch(Exception $e)
    {
        echo 'server error';
        exit();
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
        <h2>商品データ編集</h2>
        <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
            <input type="hidden" name="code" value="<?php echo $pro_code;?>">
            <input type="hidden" name="gazou_old" value="<?php echo $pro_gazou_old?>">
            <div class="form-item">
                商品名<br>
                <input type="text" class="form-control" name="name" value="<?php echo $pro_name;?>"><br>
            </div>
            <div class="form-item">
                値段<br>
                <input type="text" class="form-control" name="price" value="<?php echo $pro_price?>">
            </div>
            <?php 
                if($pro_gazou_old == '')
                {
                    echo '';
                }
                else 
                {
                    echo '<img src="./gazou/'.$pro_gazou_old.'">';
                }
            ?>
            <br>
            商品画像<br>
            <input type="file" class="form-control" name="gazou"> <br>
            <br>
            <input type="button" onclick="history.back()" value="戻る">
            <input type="submit" value="確認">
        </form>
    </div>
</body>
</html>