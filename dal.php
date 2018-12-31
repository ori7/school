<?php
    class DataAccessLayer
    {
        private $host = '127.0.0.1';
        private $db = 'school';
        private $user = 'root';
        private $pass = '';
        private $charset = 'utf8';
        private $dsn;
        private $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        public function __construct()
        {
            $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        }

        public function select($query, $param = null){
            $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
            $statement = $pdo->prepare($query);
            if (empty($param))
                $statement->execute();
            else
                $statement->execute($param);
            return $statement;
        }

        public function insert($query, $params) {
            $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
            $statement = $pdo->prepare($query);
            $statement->execute($params);
            return $pdo->lastInsertId();
        }

        public function delite($query, $param) {
            $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
            $statement = $pdo->prepare($query);
            $statement->execute($param);
        }

        public function update($query, $params) {
            $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
            $statement = $pdo->prepare($query);
            $statement->execute($params);
        }
    }
?>