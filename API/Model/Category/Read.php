<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class ReadCategory{

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

    function getAllCategories(){
        $collection = 'gamesCategories';
        // read all records
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);   
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 

    function getCategoryById($params){
        $collection = 'gamesCategories';
        // read all records
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['category'])];
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