<?php
    class Database {
        private $host = 'localhost';
        private $dbName = 'todoApi';
        private $userName = 'root';
        private $password = '';
        public $conn;

        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->userName, $this->password);
                $this->conn->exec('set name utf8');
            }
            catch(PDOException $exception) {
                echo 'Connection error: '. $exception->getMessage();
            }

            return $this->conn;
        }
    }
?>