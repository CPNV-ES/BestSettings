<?php
// required headers
require_once "Model/Category/Read.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
class ReadGame{

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
        $filter = ['_id' => new MongoDB\BSON\ObjectId($params['games'])];
        $option = [];
        $read = new MongoDB\Driver\Query($filter, $option);
        //fetch records
        $records = $this->conn->executeQuery("$this->dbname.$collection", $read); 
        
        $records = $records->toArray();
        
        foreach($records as $record)
        {
            //declaration of class
            $Category = new ReadCategory;

            //Get Categories of game and append to record
            $ArrayCategories = [];
            foreach($record->gameCategories as $categories)
            {
                $id['categories']=$categories->gameCategoryId;
                $id['return']= 1;
                
                $categorie = array_shift($Category->getCategoriesById($id));
                array_push($ArrayCategories,$categorie);
            }
            $record->gameCategories = $ArrayCategories;
            //Get plateform of game and append to record
            /* foreach($record->gameCategories as $categories)
            {
                $id['categories']=$categories->gameCategoryId;
                $id['return']= 1;
                $record->gameCategories = [];
                array_push($record->gameCategories, $Category->getCategoriesById($id));
            } */
            echo json_encode($record);
        }
        
    } 
}

?>