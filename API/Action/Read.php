<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Read{

    private $dbname = "Bestsettings";
    private $conn;

    function __construct(){
        // include database file
        include_once 'Database/db.php';
        //DB connection
        $db = new DbManager();
        $this->conn = $db->getConnection();
    }



    function getAllGame(){
        $collection = 'games';
        // read all records
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);   
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 

    function getGameById($params){
        $collection = 'games';
        // read all records
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['Game'])];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 
}

?>