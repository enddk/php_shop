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
        <?php
            require_once('../common/common.php');
            $post = sanitize($_POST);

            $pro_name = $post['name'];
            $pro_price = $post['price'];
            $pro_gazou = $_FILES['gazou'];

            if($pro_name=='')
            {
                echo '商品名を入力してください。<br>';
            }
            else
            {
                echo '商品名：'.$pro_name.'<br>';
            }

            if(preg_match('/\A[0-9]+\z/',$pro_price) == 0)
            {
                echo '値段を入力して下さい。<br>';
            }
            else
            {
                echo '値段：'.$pro_price.'<br>';
            }

            if($pro_gazou['size'] > 0)
            {
                if($pro_gazou['size'] > 1000000)
                {
                    echo 'ファイルサイズが大きすぎます。<br>';
                }
                else
                {
                    move_uploaded_file($pro_gazou['tmp_name'], './gazou/'.$pro_gazou['name']);
                    echo '<img src="./gazou/'.$pro_gazou['name'].'" alt="">';
                    echo '<br>';
                }
            }

            if($pro_name==''||preg_match('/\A[0-9]+\z/',$pro_price) == 0 || $pro_gazou['size'] > 1000000)
            {
                echo '<form>';
                echo '<input type="button" onclick="history.back()" value="戻る">';
                echo '</form>';
            }
            else
            {
                echo '<form method="post" action="pro_add_done.php">';
                echo '<input type="hidden" name="name" value="'.$pro_name.'">';
                echo '<input type="hidden" name="price" value="'.$pro_price.'">';
                echo '<input type="hidden" name="gazou" value="'.$pro_gazou['name'].'">';
                echo '<br>';
                echo '<input type="button" onclik="history.back()" value="戻る">';
                echo '<input type="submit" value="確認">';
                echo '</form>';
            }
        ?>
    </div>
</body>
</html>