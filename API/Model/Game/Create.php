<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class CreateGame{

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

    public function CreateGame(){
        $collection = 'games';
        $jsondata = file_get_contents('php://input');
        $game = json_decode($jsondata);
        $this->bulk->insert(['name' =>$game->name, 'logo' =>$game->logo, 'platforms' => $game->platforms, 'gameCategories' => $game->gameCategories, 'gameConfigurations' => $game->gameConfigurations]);
        $result  = $this->manager->executeBulkWrite("$this->dbname.$collection", $this->bulk);;
        $json = array(
            'number' => $result->getInsertedCount()
        );
        echo json_encode($json);
    }
}
?>
