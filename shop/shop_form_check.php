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
        require_once('../common/common.php');

        $post = sanitize($_POST);

        $name = $post['name'];
        $email = $post['email'];
        $postal = $post['postal'];
        $address = $post['address'];
        $tel = $post['tel'];

        $okflg = true;

        if($name == '')
        {
            echo 'no name <br>';
            $okflg = false;
        } else {
            echo 'your name <br>';
            echo $name.'<br>';
        }

        if(preg_match("/\A[\w\\.]+\@[\w\\.]+\.([a-z]+)\z/", $email) == 0)
        {
            echo 'no email <br>';
            $okflg = false;
        } else {
            echo 'your email <br>';
            echo $email.'<br>';
        }

        if(preg_match("/\A\d{3}-?\d{4}\z/", $postal) == 0)
        {
            echo 'no postal <br>';
            $okflg = false;
        } else {
            echo 'your postal <br>';
            echo $postal.'<br>';
        }

        if($address == '')
        {
            echo 'no address <br>';
            $okflg = false;
        } else {
            echo 'your address <br>';
            echo $address.'<br>';
        }

        if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) == 0)
        {
            echo 'no tel <br>';
            $okflg = false;
        } else {
            echo 'your tel <br>';
            echo $tel.'<br>';
        }

        if($okflg == true)
        {
            echo '<form method="post" action="shop_form_done.php">';
            echo '<input type="hidden" name="name" value="'.$name.'">';
            echo '<input type="hidden" name="email" value="'.$email.'">';
            echo '<input type="hidden" name="postal" value="'.$postal.'">';
            echo '<input type="hidden" name="address" value="'.$address.'">';
            echo '<input type="hidden" name="tel" value="'.$tel.'">';
            echo '<input type="button" onclick="history.back()" value="back">';
            echo '<input type="submit" value="ok"><br>';
            echo '</form>';
        } else {
            echo '<form>';
            echo '<input type="button" onclick="history.back()" value="back">';
            echo '</form>';
        }

    ?>
</body>
</html>