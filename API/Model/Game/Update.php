<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Update{

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

    public function updateGameById($params){
        $collection = 'games';
        $jsondata = file_get_contents('php://input');
        $game = json_decode($jsondata);
        $this->bulk->update(['_id'=>new MongoDB\BSON\ObjectID($params['games'])],['$set' => ['name' => $game->name, 'logo' =>$game->logo, 'platforms' => $game->platforms, 'gameCategories' => $game->gameCategories, 'gameConfigurations' => $game->gameConfigurations]], ['multi' => false, 'upsert' => false]);
        $result  = $this->manager->executeBulkWrite("$this->dbname.$collection", $this->bulk);;
        $json = array(
            'number' => $result->getModifiedCount()
        );
        echo json_encode($json);
    } 
}
?>