<?php
class Config{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "project";
    private $db_user = "root";
    private $db_pass = "";
    public $db;
  
    // get the database connection
    public function getConnection(){
  
        $this->db = null;
  
        try{
            $this->db = new PDO("mysql:host=" .$this->host. ";dbname=" .$this->db_name, $this->db_user, $this->db_pass);
            $this->db->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->db;
    }
}
?>
