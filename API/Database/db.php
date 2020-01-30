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
    
    function JoinMultipleData($record,$object,$function,$idName,$attribute,$idattribute){
        $DataArray = [];
        foreach($record->$attribute as $row)
        {
            if(!empty($row->$idattribute)){
                $id[$idName]=$row->$idattribute;
                $id['return']= 1;  
                $Data = array_shift($object->$function($id));
                array_push($DataArray,$Data);
            }
        }
        return $DataArray;
    }

    function JoinOneData($record,$object,$function,$idName,$attribute,$idattribute){
        $DataArray = [];
        foreach($record->$attribute as $row)
        {
            if(!empty($row->$idattribute)){
                $id[$idName]=$row->$idattribute;
                $id['return']= 1;
                $Data = array_shift($object->$function($id));
                $DataArray = $Data;
            }
        }
        return $DataArray;
    }

    function JoinUniqueData($record,$object,$function,$idName,$idattribute){
        $DataArray = [];
            if(!empty($record->$idattribute)){
                $id[$idName]=$record->$idattribute;
                $id['return']= 1;
                $Data = array_shift($object->$function($id));
                $DataArray = $Data;
            }
            return $DataArray;
        }

    function ObjectToArray($object){
        $Data[] = $object;
        return $Data;
    }
}
?>