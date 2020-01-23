<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class ReadPlatform{

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

    function getAllPlateform(){
        $collection = 'plateforms';
        // read all records
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);   
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 

    function getPlateformById($params){
        $collection = 'plateforms';
        // read all records
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['plateforms'])];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);
        if(isset($params['return']))
        {
            return (object) $records->toArray();
        }else
        {
            echo json_encode(iterator_to_array($records));
        }
    } 
}

?>