<?php
    session_start();
    session_regenerate_id(true);

    require_once('../common/common.php');

    $post = sanitize($_POST);

    $max = $post['max'];
    for($i = 0; $i < $max; $i++)
    {
        if(preg_match("/\A[0-9]+\z/", $post['kazu'.$i]) == 0)
        {
            echo 'not number';
            echo '<a href="shop_cartlook.php">back</a>';
            exit();
        }
        $kazu[] = $post['kazu'.$i];
    }

    $cart = $_SESSION['cart'];

    for($i = $max; 0 <= $i; $i--)
    {
        if(isset($_POST['sakujyo'.$i]) == true)
        {
            array_splice($cart, $i, 1);
            array_splice($kazu, $i, 1);
        }
    }

    $_SESSION['cart'] = $cart;
    $_SESSION['kazu'] = $kazu;

    header('Location:shop_cartlook.php');
    exit();
?>