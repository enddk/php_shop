<?php
    class Validation {
        const ERROR_STR01 = '<p class="text-danger mb-0">入力してください</p>';
        const ERROR_STR02 = '<p class="text-danger mb-0">メールアドレスを入力してください</p>';
        const ERROR_STR03 = '<p class="text-danger mb-0">お届け住所を入力してください</p>';
        const ERROR_STR04 = '<p class="text-danger mb-0">郵便番号を入力してください</p>';
        const ERROR_STR05 = '<p class="text-danger mb-0">電話番号を入力してください</p>';
        const ERROR_STR06 = '<p class="text-danger mb-0">パスワードを正しく入力してください</p>';
    
        private $_name;
        private $_mail;
        private $_postal;
        private $_address;
        private $_tel;
        private $_password;

        public function FormCheck()
        {
            $error = array();
        
            $error['error'] = false;
            
            $error['name'] = false;
            if( !self::getName() )
                $error['error'] = $error['name'] = true;
            
            $error['mail'] = false;
            if( !self::getMail() || (preg_match("/\A[\w\\.]+\@[\w\\.]+\.([a-z]+)\z/", self::getmail()) == 0))
                $error['error'] = $error['mail'] = true;
            
            $error['postal'] = false;
            if( !self::getPostal() || (preg_match("/\A\d{3}-?\d{4}\z/",  self::getpostal()) == 0))
                $error['error'] = $error['postal'] = true;
                
            $error['address'] = false;
            if( !self::getAddress() )
                $error['error'] = $error['address'] = true;
            
            $error['tel'] = false;
            if( !self::getTel() || (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', self::getTel()) == 0))
                $error['error'] = $error['tel'] = true;

            $error['password'] = false;
            if( !self::getPassword() )
                $error['error'] = $error['password'] = true;
            
            return $error;
        }

        public function LoginCheck()
        {
            $error = array();
        
            $error['error'] = false;

            $error['mail'] = false;
            if( !self::getMail() || (preg_match("/\A[\w\\.]+\@[\w\\.]+\.([a-z]+)\z/", self::getmail()) == 0))
                $error['error'] = $error['mail'] = true;

            $error['password'] = false;
            if( !self::getPassword() )
                $error['error'] = $error['password'] = true;
            
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
        public function setPassword( $val ){
            $this->_password = $val;
        }
        public function getPassword(){
            return $this->_password;
        }
    }
?>