<?php
include('Router.php');

//Games route
Router::add('GET','/games', 'Game/ReadGame@getAllGame');
Router::add('GET','/games/id', 'Game/ReadGame@getAllInformationOfGameById');
Router::add('POST','/games', 'Game/Create@CreateGame');
Router::add('DELETE','/games/id', 'Game/Delete@deleteGameById' );
Router::add('PUT','/games/id', 'Game/Update@updateGameById' );

//Categories route
Router::add('GET','/categories', 'Category/ReadCategory@getAllCategories');
Router::add('GET','/categories/id', 'Category/ReadCategory@getCategoriesById');
Router::add('POST','/categories', 'Category/Create@CreateGame');
Router::add('DELETE','/categories/id', 'Category/Delete@deleteGameById' );
Router::add('PUT','/categories/id', 'Category/Update@updateGameById' );

//Categories route
Router::add('GET','/plateforms', 'Plateform/ReadPlatform@getAllPlateform');
Router::add('GET','/plateforms/id', 'Plateform/ReadPlatform@getPlateformById');
Router::add('POST','/plateforms', 'Plateform/CreatePlatform@CreatePlatform');
Router::add('DELETE','/plateforms/id', 'Plateform/DeletePlaform@deletePlateformById' );
Router::add('PUT','/plateforms/id', 'Plateform/PlateformUpdate@updatePlatefromById' );

Router::run();
?>
