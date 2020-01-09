<?php
include('Router.php');
//route to the index pages
Router::add('GET','/Game', 'Read@getAllGame' );
Router::run();   

?>