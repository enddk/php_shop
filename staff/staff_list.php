<?php
    session_start();
    session_regenerate_id(true);
    if(isset($_SESSION['login']) == false)
    {
        header('Location:../staff_login/staff_login.php');
    }
    else
    {
        echo $_SESSION['staff_name'].'さんがログイン中<br><br>';
    }
?>
<?php
    try
    {
        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT code, name FROM mst_staff WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;
    }

    catch(Exceprion $e)
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
        <h2>スタッフリスト</h2>
        <form action="staff_branch.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while(true)
                        {
                            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
                            if($rec == false)
                            {
                                break;
                            }
                            echo '<tr>';
                            echo '<td><p>'.$rec['code'].'</p></td>';
                            echo '<td><p>'.$rec['name'].'</p></td>';
                            echo '<td><input type="radio" name="staffcode" value="'.$rec['code'].'" checked></td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
    
            <input type="submit" name="disp" value="参照">
            <input type="submit" name="add" value="追加">
            <input type="submit" name="edit" value="編集">
            <input type="submit" name="delete" value="削除">
        </form>

        <a href="../staff_login/staff_top.php">トップページ</a>
    </div>


</body>
</html>