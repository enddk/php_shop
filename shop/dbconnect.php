<?php
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
    }
?>