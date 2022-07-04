<?php
    class Session {

        function __construct() {
            session_start();
            session_regenerate_id(true);
        }

        public function CheckLogin() {
            if(isset($_SESSION['member_login']) == false)
            {
                echo 'wellcome gest <a href="member_login.php">member login</a><br><br>';
            }
            else
            {
                echo 'wellcome '.$_SESSION['member_name'].' <a href="member_logout.php">member logout</a><br><br>';
            }
        }

        public function CartIn(int $pro_code) {
            try
            {    
                if(empty($_SESSION['cart'])){
                    $_SESSION['cart'] = [];
                    $_SESSION['kazu'] = [];
                }

                if(isset($_SESSION['cart']) == true)
                {
                    $cart = $_SESSION['cart'];
                    $kazu = $_SESSION['kazu'];
                    if(in_array($pro_code, $cart) == true)
                    {
                        $key = array_search($pro_code, $cart);
                        $kazu[$key] +=1;
                    } else {
                        $cart[] = $pro_code;
                        $kazu[] = 1;
                    }
                }
                $_SESSION['cart'] = $cart;
                $_SESSION['kazu'] = $kazu;
            }
            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function CartLook() {
            try
            {
                if(empty($_SESSION['cart']) || empty($_SESSION['kazu']))
                {
                    return null;
                    exit();
                }

                $cart = $_SESSION['cart'];
                $kazu = $_SESSION['kazu'];
                $max = count($cart);

                if(isset($_SESSION['cart']) == true)
                {
                    $cart = $_SESSION['cart'];
                    $kazu = $_SESSION['kazu'];
                    $max = count($cart);
                }
                else
                {
                    $max = 0;
                }

                $data = array();

                if($max == 0)
                {
                    $data = null;
                } else {
                    $data['cart'] = $cart;
                }

                $data['kazu'] = $kazu;
                $data['max'] = $max;

                return $data;
            }

            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function kazu_change($POST) {
            require_once('../common/common.php');

            $post = sanitize($POST);

            $max = $post['max'];
            $cart = $_SESSION['cart'];

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
        }
    }
?>