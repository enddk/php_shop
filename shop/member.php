<?php
    include 'dbconnect.php';
    include 'session.php';

    class Member extends DB {
        private $userName;
        private $userId;
        
        public function Signin ($POST) {
            try {
                require_once('./common.php');
                $PDO = parent::ConnectDB();

                $post = sanitize($POST);

                $name = $post['name'];
                $email = $post['email'];
                $postal = $post['postal'];
                $address = $post['address'];
                $tel = $post['tel'];
                $password = $post['password'];

                $sql = 'INSERT INTO member (name, email, postal, address, tel, password) VALUES (?,?,?,?,?,?)';
                $stmt = $PDO->prepare($sql);
                $data = array();
                $data[] = $name;
                $data[] = $email;
                $data[] = $postal;
                $data[] = $address;
                $data[] = $tel;
                $data[] = $password;
                $stmt->execute($data);
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
                exit();
            }
        }

        public function Login ($POST) {
            try {

                require_once('./common.php');

                $PDO = parent::ConnectDB();
    
                $post = sanitize($POST);
    
                $address = $post['email'];
                $password = $post['password'];
    
                $sql = 'SELECT * FROM member WHERE email=? AND password=?';
                $stmt = $PDO->prepare($sql);
                $data[] = $address;
                $data[] = $password;
                $stmt->execute($data);
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if($rec == false)
                {
                    
                }
                else
                {
                    session_start();
                    $_SESSION['name'] = $rec['name'];
                    $_SESSION['id'] = $rec['id'];
                    header('Location: shop_list.php');
                }
            }
            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function getData(int $id) {
            try {
                require_once('./common.php');
                $PDO = parent::ConnectDB();

                $sql = 'SELECT * FROM member WHERE id = ?';

                $stmt = $PDO->prepare($sql);
                $data[] = $id;
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                $data = array();

                $data['id'] = $rec['id'];
                $data['name'] = $rec['name'];
                $data['email'] = $rec['email'];
                $data['postal'] = $rec['postal'];
                $data['address'] = $rec['address'];
                $data['tel'] = $rec['tel'];
                $data['password'] = $rec['password'];
                
                return $data;  
            }
            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function EditData($POST) {
            try {
                require_once('./common.php');
                $PDO = parent::ConnectDB();

                $post = sanitize($POST);

                $name = $post['name'];
                $email = $post['email'];
                $postal = $post['postal'];
                $address = $post['address'];
                $tel = $post['tel'];
                $password = $post['password'];
                $id = $post['id'];

                $sql = 'UPDATE member SET name=?, email=?, postal=?, address=?, tel=?, password=? WHERE id=?';
                $stmt = $PDO->prepare($sql);
                $data[] = $name;
                $data[] = $email;
                $data[] = $postal;
                $data[] = $address;
                $data[] = $tel;
                $data[] = $password;
                $data[] = $id;
                $stmt->execute($data);

                header('Location: shop_mypage.php');
            }
            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function Logout () {
            session_start();
            unset($_SESSION['name']);
            unset($_SESSION['id']);
            unset($_SESSION['login']);
            header( "Location: ./shop_list.php" ) ;
        }

        public function CheckLogin() {
            session_start();
            if(isset($_SESSION['login']) == false)
            {
                echo 'ようこそ、ゲストさん<br><a href="shop_login.php">ログイン</a> / <a href="shop_signin.php">会員登録</a><br><br>';
            }
            else
            {
                echo 'ようこそ、 '.$_SESSION['name'].'さん<br><a href="shop_logout.php">ログアウト</a><br><br>';
            }
        }
    }
?>