<?php
    include 'session.php';  

    class Cart extends Session {
        public function CartLook () {
            try {
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
                } else {
                    $max = 0;
                }

                $data = array();

                if($max === 0)
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

        public function CartIn (int $pro_code) {
            try {
                if(empty($_SESSION['cart']))
                {
                    $_SESSION['cart'] = [];
                    $_SESSION['kazu'] = [];
                }

                if(isset($_SESSION['cart']) === true)
                {
                    $cart = $_SESSION['cart'];
                    $kazu = $_SESSION['kazu'];

                    if(in_array($pro_code, $cart) === true)
                    {
                        $key = array_search($pro_code, $cart);
                        $kazu[$key] += 1;
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

        public function CartChange ($POST) {
            require_once('./common.php');

            $post = sanitize($POST);

            $max = $post['max'];
            $cart = $_SESSION['cart'];

            for($i = 0; $i < $max; $i++)
            {
                if(preg_match("/\A[0-9]+\z/", $post['kazu'.$i]) == 0)
                {
                    header('Location: ./shop_cart.php');
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

        public function cartReset() {
            unset($_SESSION['cart']);
            unset($_SESSION['kazu']);
            unset($_SESSION['max']);
        }
    }
?>