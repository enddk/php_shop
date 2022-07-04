<?php
    include 'session.php';
    $Session = new Session();
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
        try{
            require_once('../common/common.php');

            $post = sanitize($_POST);

            $name = $post['name'];
            $email = $post['email'];
            $postal = $post['postal'];
            $address = $post['address'];
            $tel = $post['tel'];

            echo 'thank you order <br>';
            echo 'please check your mail <br>';
            echo 'send your address <br>';
            echo $postal.'<br>';
            echo $address.'<br>';
            echo $tel.'<br>';

            $honbun = '';

            $cart = $_SESSION['cart'];
            $kazu = $_SESSION['kazu'];
            $max = count($cart);

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            for($i = 0; $i < $max; $i++)
            {
                $sql = 'SELECT name, price FROM mst_product WHERE code = ?';
                $stmt = $dbh->prepare($sql);
                $data[0] = $cart[$i];
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                $name = $rec['name'];
                $price = $rec['price'];
                $kakaku[] = $price;
                $suryo = $kazu[$i];
                $shokei = $price * $suryo;

                $honbun.=$name.' ';
                $honbun.=$price.'yen * ';
                $honbun.=$suryo.' = ';
                $honbun.=$shokei.' ';

                echo '<br>';
                echo nl2br($honbun);
            }

            $sql = 'LOCK TABLES dat_sales WRITE, dat_sales_product WRITE';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $sql = 'INSERT INTO dat_sales (member_id, name, email, postal, address, tel) VALUES (?,?,?,?,?,?)';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = 0;
            $data[] = $name;
            $data[] = $email;
            $data[] = $postal;
            $data[] = $address;
            $data[] = $tel;
            $stmt->execute($data);

            $sql = 'SELECT LAST_INSERT_ID()';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastcode = $rec['LAST_INSERT_ID()'];

            for($i = 0; $i < $max; $i++)
            {
                $sql = 'INSERT INTO dat_sales_product (sales_id, product_id, price, quantity) VALUES (?,?,?,?)';
                $stmt = $dbh->prepare($sql);
                $data = array();
                $data[] = $lastcode;
                $data[] = $cart[$i];
                $data[] = $kakaku[$i];
                $data[] = $kazu[$i];
                $stmt->execute($data);
            }

            $sql = 'UNLOCK TABLES';
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            $dbh = null;
        }
        catch (Exception $e)
        {
            echo 'server error';
            exit();
        }
    ?>
    <h2>ご注文が完了しました</h2>

    <br>
    <a href="shop_list.php">top</a>
</body>
</html>