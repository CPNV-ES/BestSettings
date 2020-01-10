<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class Read{

    private $dbname = "Bestsettings";

    function __construct(){
        // include database file
        include_once 'Database/db.php';
    }



    function getAllGame(){
        $collection = 'games';
        //DB connection
        $db = new DbManager();
        $conn = $db->getConnection();
        // read all records
        $filter = [];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        
        //fetch records
        $records = $conn->executeQuery("$this->dbname.$collection", $read);

        echo json_encode(iterator_to_array($records));
    } 
}

?>