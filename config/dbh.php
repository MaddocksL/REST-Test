<?php

class DBH
{
	private $DB_SERVER = "localhost";
    private $DB_DATABASE = "api_user_contacts";
    private $DB_USERNAME = "root";
    private $DB_PASSWORD = "";
    public $conn;

    public function connect()
    {
    	$this->conn = null;

    	try{
    		$this->conn = new PDO("mysql:host=" . $this->DB_SERVER . ";dbname=" . $this->DB_DATABASE,
    			$this->DB_USERNAME, $this->DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	}catch(PDOException $e){
    		echo "Connection error: " . $e->getMessage();
    	}

    	return $this->conn;
    }
}
?>