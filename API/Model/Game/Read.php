<?php
// required headers
require_once "Model/Category/Read.php";
require_once "Model/Platform/Read.php";
require_once "Model/Configuration/Read.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
class ReadGame{

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

    function getAllInformationOfGameById($params){
        $collection = 'games';
        // read all records
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['game'])];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read); 
        
        $records = $records->toArray();
        
        foreach($records as $record)
        {
            //declaration of class
            $Category = new ReadCategory;
            $Platform = new ReadPlatform;
            $gameConfiguration = new ReadConfiguration;

            //Get Categories of game and append to record
            $Categories = $this->db->Join($record,$Category,'getCategoryById','category','gamesCategories','gameCategoryId');
            $record->gamesCategories = $Categories;
            
            //Get Platforms of game and append to record
            $Plateforms = $this->db->Join($record,$Platform,'getPlatformById','platform','platforms','plateformId');
            $record->platforms = $Plateforms;

            //Get gameConfiguration of game and append to record
            $gameConfigurations = $this->db->Join($record,$gameConfiguration,'getConfigurationById','configuration','gameConfigurations','gameConfigurationId');
            $record->gameConfigurations = $gameConfigurations;

            echo json_encode($record);
        }
        
    } 
}

?>