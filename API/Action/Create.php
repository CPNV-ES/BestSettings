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

?>
