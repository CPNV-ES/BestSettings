<?php
include('Router.php');

//Games route
Router::add('GET','/games', 'Game/ReadGame@getAllGame');
Router::add('GET','/game/id', 'Game/ReadGame@getAllInformationOfGameById');
Router::add('POST','/games', 'Game/CreateGame@CreateGame');
Router::add('DELETE','/games/id', 'Game/DeleteGame@deleteGameById' );
Router::add('PUT','/games/id', 'Game/UpdateGame@updateGameById' );

//Categories route
Router::add('GET','/categories', 'Category/ReadCategory@getAllCategories');
Router::add('GET','/category/id', 'Category/ReadCategory@getCategoryById');
Router::add('POST','/category', 'Category/CreateCategory@CreateCategory');
Router::add('DELETE','/category/id', 'Category/DeleteCategory@deleteCategoryById' );
Router::add('PUT','/category/id', 'Category/UpdateCategory@updateCategoryById' );

//Categories route
Router::add('GET','/platforms', 'Platform/ReadPlatform@getAllPlatforms');
Router::add('GET','/platform/id', 'Platform/ReadPlatform@getPlatformById');
Router::add('POST','/platform', 'Platform/CreatePlatform@CreatePlatform');
Router::add('DELETE','/platform/id', 'Platform/DeletePlaform@deletePlateformById' );
Router::add('PUT','/platform/id', 'Platform/PlatformUpdate@updatePlatefromById' );

Router::run();
?>
