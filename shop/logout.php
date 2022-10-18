<?php
    include './member.php';

    $member = new Member();
    $member->Logout();
    header('Location: ./shop_list.php');
?>