<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class CreateImage{

    public function addImage(){
        $filenamelogo = $_FILES['logo']['name'];
        $filenamecard = $_FILES['card']['name'];
        $locationlogo = "Image/".$filenamelogo;
        $locationcard = "Image/".$filenamecard;
        move_uploaded_file($_FILES['logo']['tmp_name'],$locationlogo);
        move_uploaded_file($_FILES['card']['tmp_name'],$locationcard);
    }
}
?>
