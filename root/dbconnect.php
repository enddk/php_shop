<?php
    //データベース操作すべてを書く
    class DB {
        private $db_type = 'mysql';
        private $db_user = 'root';
        private $db_password = '';
        private $db_name = 'shop';
        private $db_host = 'localhost';
        private $db_char = 'utf8';
        private $dsn = '';
        private $dbh = '';
        
        function __construct() {
            $this->dsn = $this->db_type.':dbname='.$this->db_name.';host='.$this->db_host.';charset='.$this->db_char;
        }

        public function ConnectDB() {
            try {
                if(!$this->dbh) {
                    $this->dbh = new PDO($this->dsn, $this->db_user, $this->db_password);
                    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }

                return $this->dbh;
            } 
            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function getStaff() {
            try {
                $PDO = $this->ConnectDB();
                
                $sql = 'SELECT * FROM mst_staff WHERE 1';

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

        public function getStaffOnly(int $code) {
            try {

                $PDO = $this->ConnectDB();

                if($code === 0) {
                    return;
                } else {
                    $sql = 'SELECT * FROM mst_staff WHERE code = ?';
    
                    $data = [];
    
                    $stmt = $PDO->prepare($sql);
                    $data[] = $code;
                    $stmt->execute($data);
    
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
                
            }

            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function EditStaff($POST) {
            try {
                require_once('./common.php');
                $PDO = $this->ConnectDB();

                $post = sanitize($POST);
                
                if(empty($_POST['code'])) {
                    $name = $post['name'];
                    $password = $post['password'];

                    $sql = 'INSERT INTO mst_staff (name, password) VALUES (?,?)';
                    $stmt = $PDO->prepare($sql);
                    $data[] = $name;
                    $data[] = $password;
                    $data[] = $code;
                    $stmt->execute($data);

                    header('Location: ./root_staffList.php');
                } else {
                    $name = $post['name'];
                    $password = $post['password'];
                    $code = $post['code'];
    
                    $sql = 'UPDATE mst_staff SET name=?, password=? WHERE code=?';
                    $stmt = $PDO->prepare($sql);
                    $data[] = $name;
                    $data[] = $password;
                    $data[] = $code;
                    $stmt->execute($data);
                    
                    header('Location: ./root_staffList.php');
                }

            }
            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function deleteStaff() {
            
        }

        public function getMember() {
            try {
                $PDO = $this->ConnectDB();
                
                $sql = 'SELECT * FROM member WHERE 1';

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

        public function getMemberOnly(int $id) {
            try {
                $PDO = $this->ConnectDB();

                if($id === 0) {
                    return;
                } else {
                    $sql = 'SELECT * FROM member WHERE id = ?';
    
                    $data = [];
    
                    $stmt = $PDO->prepare($sql);
                    $data[] = $id;
                    $stmt->execute($data);
    
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
                
            }

            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function getProduct() {
            try {
                $PDO = $this->ConnectDB();
                
                $sql = 'SELECT * FROM mst_product WHERE 1';

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

        public function getProductOnly(int $code) {
            try {
                $PDO = $this->ConnectDB();

                if($code === 0) {
                    return;
                } else {
                    $sql = 'SELECT * FROM mst_product WHERE code = ?';
    
                    $data = [];
    
                    $stmt = $PDO->prepare($sql);
                    $data[] = $code;
                    $stmt->execute($data);
    
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
                
            }

            catch(Exceprion $e)
            {
                echo 'server error';
                exit();
            }
        }

        public function staffLogin($POST) {
            try {

                require_once('./common.php');

                $PDO = $this->ConnectDB();
    
                $post = sanitize($POST);
    
                $code = $post['code'];
                $password = $post['password'];
    
                $sql = 'SELECT * FROM mst_staff WHERE code=? AND password=?';
                $stmt = $PDO->prepare($sql);
                $data[] = $code;
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
                    $_SESSION['code'] = $rec['code'];
                    header('Location: root_top.php');
                }
            }
            catch(Exception $e)
            {
                echo 'server error';
                exit();
            }
        }
    }
?>