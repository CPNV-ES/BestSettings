<?php
// connect to mongodb
class DbManager{

    public $dbname = "Bestsettings";
    private $dbhost = "localhost";
    private $dbport = '27017';
    private $conn;

    function __construct(){
        //Connecting to MongoDB
        try {
			//Establish database connection
            $this->conn = new MongoDB\Driver\Manager("mongodb://".$this->dbhost.':'.$this->dbport);
        }catch (MongoDBDriverExceptionException $e) {
            echo $e->getMessage();
			echo nl2br("n");
        }
    }
	function getConnection() {
		return $this->conn;
    }
    
    function Join($record,$object,$function,$idName,$attribute,$idattribute){
        $DataArray = [];
        foreach($record->$attribute as $row)
        {
            $id[$idName]=$row->$idattribute;
            $id['return']= 1;
            if(!is_null($id[$idName]))
            {   
                $Data = array_shift($object->$function($id));
                array_push($DataArray,$Data);
            }
        }
        return $DataArray;
    }
}
?>