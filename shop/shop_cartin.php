<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['member_login']) == false)
    {
        echo 'wellcome gest <a href="member_login.php">member login</a><br><br>';
    }
    else
    {
        echo 'wellcome '.$_SESSION['member_name'].' <a href="member_logout.php">member logout</a><br><br>';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        try
        {
            $pro_code = $_GET['procode'];

            if(isset($_SESSION['cart']) == true)
            {
                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                if(in_array($pro_code, $cart) == true)
                {
                    echo 'in cart';
                    echo '<a href="shop_list.php">back</a>';
                    exit();
                }
            }
            $cart[] = $pro_code;
            $kazu[] = 1;
            $_SESSION['cart'] = $cart;
            $_SESSION['kazu'] = $kazu;
        }
        catch(Exception $e)
        {
            echo 'server error';
            exit();
        }
    ?>

   in cart <br>
   <br>
   <a href="shop_list.php">back</a>
</body>
</html>