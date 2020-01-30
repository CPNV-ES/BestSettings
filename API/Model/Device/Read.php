<?php
// required headers
require_once "Model/GraphicConfig/Read.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
class ReadDevice{

    private $conn;
    private $dbname;
    private $db;

    function __construct(){
        // include database file
        include_once 'Database/db.php';
        //DB connection
        $this->db = new DbManager();
        $this->dbname = $this->db->dbname;
        $this->conn = $this->db->getConnection();
    }

    function getAllDevices(){
        $collection = 'devices';
        // read all records
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);   
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 

    function getDeviceById($params){
        $collection = 'devices';
        // read all records
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['device'])];
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