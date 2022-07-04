<?php
    include 'dbconnect.php';
    
    class Product extends DB {
        const ERROR_STR01 = '入力してください';
        const ERROR_STR02 = 'メールアドレスを入力してください';
        const ERROR_STR03 = 'お届け住所を入力してください';
        const ERROR_STR04 = '郵便番号を入力してください';
        const ERROR_STR05 = '電話番号を入力してください';
    
        private $_name;
        private $_mail;
        private $_postal;
        private $_address;
        private $_tel;

        public function getData() {
            try {
                $PDO = parent::ConnectDB();

                $sql = 'SELECT code, name, price, gazou FROM mst_product WHERE 1';

                $stmt = $PDO->prepare($sql);
                $stmt->execute();

                $data = array();
                
                while(true)
                {
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($rec == false)
                    {
                        break;
                    }
                    $data[] = $rec;
                }

                return $data;
                
            }

            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function getDataOnly(int $pro_code) {
            try{
                $PDO = parent::ConnectDB();
    
                $sql = 'SELECT name, price, gazou FROM mst_product WHERE code=?';
                $stmt = $PDO->prepare($sql);
                $data[] = $pro_code;
                $stmt->execute($data);
    
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
                $data = array();
    
                $data['code'] = $pro_code;
                $data['name'] = $rec['name'];
                $data['price'] = $rec['price'];
                $data['gazou'] = $rec['gazou'];

                return $data;
            } 
            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function getCart(Session $Session) {
            try {
                $PDO = parent::ConnectDB();

                $cart = $Session->CartLook();

                if(!empty($cart))
                {
                    $carts = array();
    
                    foreach($cart['cart'] as $key => $val)
                    {
                        $sql = 'SELECT code, name, price, gazou FROM mst_product WHERE code=?';
                        $stmt = $PDO->prepare($sql);
                        $data[0] = $val;
                        $stmt->execute($data);
    
                        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    
                        $pro_name[] = $rec['name'];
                        $pro_price[] = $rec['price'];
    
                        if($rec['gazou'] == '')
                        {
                            $pro_gazou[] = '';
                        }
                        else
                        {
                            $pro_gazou[] = '<img src="../product/gazou/'.$rec['gazou'].'">';
                        }
                    }
    
                    $carts['name'] = $pro_name;
                    $carts['price'] = $pro_price;
                    $carts['gazou'] = $pro_gazou;
                    $carts['kazu'] = $cart['kazu'];
                    $carts['max'] = $cart['max'];
    
                } else {
                    $carts['max'] = 0;
                }
                return $carts;
            }
            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }

        
        public function insertBuyData($POST, Session $Session)
        {
            try{
                require_once('../common/common.php');

                $PDO = parent::ConnectDB();

                $post = sanitize($POST);

                $name = $post['name'];
                $email = $post['email'];
                $postal = $post['postal'];
                $address = $post['address'];
                $tel = $post['tel'];

                $session = $Session->CartLook();

                $cart = $session['cart'];
                $kazu = $session['kazu'];
                $max = count($cart);
                
                $sql = 'LOCK TABLES dat_sales WRITE, dat_sales_product WRITE';
                $stmt = $PDO->prepare($sql);
                $stmt->execute();
                
                $sql = 'INSERT INTO dat_sales (member_id, name, email, postal, address, tel) VALUES (?,?,?,?,?,?)';
                $stmt = $PDO->prepare($sql);
                $data = array();
                $data[] = 0;
                $data[] = $name;
                $data[] = $email;
                $data[] = $postal;
                $data[] = $address;
                $data[] = $tel;
                $stmt->execute($data);

                $sql = 'SELECT LAST_INSERT_ID()';
                $stmt = $PDO->prepare($sql);
                $stmt->execute();
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                $lastcode = $rec['LAST_INSERT_ID()'];

                $data = array();

                for($i = 0; $i < $max; $i++)
                {
                    $sql = 'SELECT name, price FROM mst_product WHERE code = ?';
                    $stmt = $PDO->prepare($sql);
                    $data[0] = $cart[$i];
                    $stmt->execute($data);

                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                    $name = $rec['name'];
                    $price = $rec['price'];
                    $kakaku[] = $price;
                    $suryo = $kazu[$i];
                    $shokei = $price * $suryo;
                }
                

                for($i = 0; $i < $max; $i++)
                {
                    $sql = 'INSERT INTO dat_sales_product (sales_id, product_id, price, quantity) VALUES (?,?,?,?)';
                    $stmt = $PDO->prepare($sql);
                    $data = array();
                    $data[] = $lastcode;
                    $data[] = $cart[$i];
                    $data[] = $kakaku[$i];
                    $data[] = $kazu[$i];
                    $stmt->execute($data);
                }

                $sql = 'UNLOCK TABLES';
                $stmt = $PDO->prepare($sql);
                $stmt->execute();
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
                exit();
            }
        }

        public function FormCheck()
        {
            $error = array();
        
            $error['error'] = false;
            
            $error['name'] = false;
            if( !self::getName() )
                $error['error'] = $error['name'] = true;
            
            $error['mail'] = false;
            if( self::getmail() == ''  || (preg_match("/\A[\w\\.]+\@[\w\\.]+\.([a-z]+)\z/", self::getmail()) == 0))
                $error['error'] = $error['mail'] = true;
            
            $error['postal'] = false;
            if( !self::getpostal() || (preg_match("/\A\d{3}-?\d{4}\z/",  self::getpostal()) == 0))
                $error['error'] = $error['postal'] = true;
                
            $error['address'] = false;
            if( !self::getaddress() )
                $error['error'] = $error['address'] = true;
            
            $error['tel'] = false;
            if( !self::getTel() || (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', self::getTel()) == 0))
                $error['error'] = $error['tel'] = true;
            
            return $error;
        }

        public function setName( $val ){
            $this->_name = $val;
        }
        public function getName(){
            return $this->_name;
        }
        public function setMail( $val ){
            $this->_mail = $val;
        }
        public function getMail(){
            return $this->_mail;
        }
        public function setPostal( $val ){
            $this->_postal = $val;
        }
        public function getPostal(){
            return $this->_postal;
        }
        public function setAddress( $val ){
            $this->_address = $val;
        }
        public function getAddress(){
            return $this->_address;
        }
        public function setTel( $val ){
            $this->_tel = $val;
        }
        public function getTel(){
            return $this->_tel;
        }
    }
?>