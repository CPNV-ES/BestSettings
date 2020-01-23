<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class DeletePlaform{

    private $conn;
    private $dbname;
    private $bulk;
    private $manager;

    function __construct(){
        // include database file
        include_once 'Database/db.php';
        //DB connection
        $db = new DbManager();
        $this->dbname = $db->dbname;
        $this->conn = $db->getConnection();
        $this->bulk = new MongoDB\Driver\BulkWrite;
        $this->manager = new MongoDB\Driver\Manager;
    }
    
    public function deletePlateformById($params){
        $collection = 'platforms';
        $this->bulk->delete(['_id' => new MongoDB\BSON\ObjectId($params['platform'])], ['limit' => 1]);
        $result = $this->manager->executeBulkWrite("$this->dbname.$collection",$this->bulk);
        $json = array(
            'number' => $result->getDeletedCount()
        );
        echo json_encode($json);
    } 
}
?>