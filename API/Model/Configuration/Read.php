<?php
// required headers
require_once "Model/GraphicConfig/Read.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
class ReadConfiguration{

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

    function getAllConfiguration(){
        $collection = 'configurations';
        // read all records
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);   
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 

    function getConfigurationById($params){
        $collection = 'configurations';
        // read all records
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['configuration'])];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read); 
        
        if(isset($params['return']))
        {
            foreach($records as $record)
                {
                    //declaration of class
                    $graphicConfiguration = new ReadGraphicConfig;
                    //Get Categories of game and append to record
                    $graphicConfigurations = $this->db->JoinOneData($record,$graphicConfiguration,'getGraphicConfigById','graphicsConfig','graphicsConfigs','graphicsConfigId');
                    $record->graphicsConfigs = $graphicConfigurations;
                    $record = $this->db->ObjectToArray($record);
                    return $record;
                }
        }else
        {
            echo json_encode(iterator_to_array($records));
        }      
    } 
}

?>