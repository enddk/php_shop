<?php
    session_start();
    $_SSESSION = array();
    if(isset($_COOKIE[session_name()]) == true)
    {
        setcookie(session_name(),'',time()-4200,'/');
    }
    session_destroy();
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
    clear cart<br>
    
</body>
</html>