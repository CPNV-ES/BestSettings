<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class ReadPlatform{

<<<<<<< HEAD:API/Action/Read.php
    private $dbname = "BestSettings";
=======
>>>>>>> feature/APIv2:API/Model/Platform/Read.php
    private $conn;
    private $dbname;

    function __construct(){
        // include database file
        include_once 'Database/db.php';
        //DB connection
        $db = new DbManager();
        $this->dbname = $db->dbname;
        $this->conn = $db->getConnection();
    }

    function getAllPlatforms(){
        $collection = 'platforms';
        // read all records
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);   
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 

    function getPlatformById($params){
        $collection = 'platforms';
        // read all records
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['platform'])];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);
        if(isset($params['return']))
        {
            return $records->toArray();

        }else
        {
            echo json_encode(iterator_to_array($records));
        }
    } 
}

?>