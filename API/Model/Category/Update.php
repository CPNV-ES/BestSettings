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
        $collection = 'gamesCategories';
        $jsondata = file_get_contents('php://input');
        $category = json_decode($jsondata);
        $this->bulk->update(['_id'=>new MongoDB\BSON\ObjectID($params['categories'])],['$set' => ['name' =>$category->name, 'logo' =>$category->logo]], ['multi' => false, 'upsert' => false]);
        $result  = $this->manager->executeBulkWrite("$this->dbname.$collection", $this->bulk);;
        $json = array(
            'number' => $result->getModifiedCount()
        );
        echo json_encode($json);
    } 
}
?>