<?php
include('Router.php');
//Games route
Router::add('GET','/games', 'Game/Read@getAllGame');
Router::add('GET','/games/id', 'Game/Read@getGameById');
Router::add('POST','/games', 'Game/Create@CreateGame');
Router::add('DELETE','/games/id', 'Game/Delete@deleteGameById' );
Router::add('PUT','/games/id', 'Game/Update@updateGameById' );
//Categories route
Router::add('GET','/categories', 'Category/Read@getAllGame');
Router::add('GET','/categories/id', 'Category/Read@getGameById');
Router::add('POST','/categories', 'Category/Create@CreateGame');
Router::add('DELETE','/categories/id', 'Category/Delete@deleteGameById' );
Router::add('PUT','/categories/id', 'Category/Update@updateGameById' );
Router::run();
?>