<?php
class Database{
    private $host = "localhost";
    private $db_name = "analim";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection() : PDO
    {
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception){
                echo "Connexion BD impossible : " . $exception->getMessage();
            }
            return $this->conn;
    }

}
?>