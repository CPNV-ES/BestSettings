<?php
include('Router.php');
//Games route
Router::add('GET','/games', 'Game/Read@getAllGame');
Router::add('GET','/games/id', 'Game/Read@getGameById');
Router::add('POST','/games', 'Game/Create@CreateGame');
Router::add('DELETE','/games/id', 'Game/Delete@deleteGameById' );
Router::add('PUT','/games/id', 'Game/Update@updateGameById' );
Router::run();
?>