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
        echo $_SESSION['staff_name'].' さん<br><br>';
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
<body>
<body style="padding-top:70px;">
    <div class="container">
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <a href="#" class="navbar-brand">管理者サイト</a>
        </nav>
        <?php
            require_once('../common/common.php');
            $post = sanitize($_POST);
            
            $staff_name = $post['name'];
            $staff_pass = $post['pass'];
            $staff_pass2 = $post['pass2'];


            if($staff_name=='')
            {
                echo '名前を入力してください';
            }
            else
            {
                echo '名前：'.$staff_name.'を追加します。<br>';
            }

            if($staff_pass=='')
            {
                echo 'パスワードを入力してください。';
            }

            if($staff_pass!=$staff_pass2)
            {
                echo '確認用パスワードが違います。';
            }

            if($staff_name==''||$staff_pass==''||$staff_pass!=$staff_pass2)
            {
                echo '<form>';
                echo '<input type="button" onclick="history.back()" value="戻る">';
                echo '</form>';
            }
            else
            {
                $staff_pass = md5($staff_pass);
                echo '<form method="post" action="staff_add_done.php">';
                echo '<input type="hidden" name="name" value="'.$staff_name.'">';
                echo '<input type="hidden" name="pass" value="'.$staff_pass.'">';
                echo '<br>';
                echo '<input type="button" onclick="history.back()" value="戻る">';
                echo '<input type="submit" value="追加">';
                echo '</form>';
            }
        ?>
    </div>
</body>
</html>