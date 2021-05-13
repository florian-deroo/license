<?php
class Database{
  
    // specify your own database credentials
    private $host = "eu-cdbr-west-01.cleardb.com";
    private $db_name = "heroku_b79658086617fa8";
    private $username = "b128257f20cf72";
    private $password = "2637a773";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>