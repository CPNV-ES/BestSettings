<?php
// connect to mongodb
class DbManager{

    private $dbhost = "localhost";
    private $dbport = '27017';
    private $conn;

    function __construct(){
        //Connecting to MongoDB
        try {
			//Establish database connection
            $this->conn = new MongoDB\Driver\Manager("mongodb://".$this->dbhost.':'.$this->dbport);
        }catch (MongoDBDriverExceptionException $e) {
            echo $e->getMessage();
			echo nl2br("n");
        }
    }
	function getConnection() {
		return $this->conn;
	}
}
?>