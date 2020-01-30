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

//platforms route
Router::add('GET','/platforms', 'Platform/ReadPlatform@getAllPlatforms');
Router::add('GET','/platform/id', 'Platform/ReadPlatform@getPlatformById');
Router::add('POST','/platform', 'Platform/CreatePlatform@CreatePlatform');
Router::add('DELETE','/platform/id', 'Platform/DeletePlaform@deletePlateformById' );
Router::add('PUT','/platform/id', 'Platform/PlatformUpdate@updatePlatefromById' );

//configurations route
Router::add('GET','/configurations', 'Configuration/ReadConfiguration@getAllConfiguration');
Router::add('GET','/configuration/id', 'Configuration/ReadConfiguration@getConfigurationById');

//graphicsConfig route
Router::add('GET','/graphicsConfig', 'GraphicConfig/ReadGraphicConfig@getAllGraphicConfig');
Router::add('GET','/graphicsConfig/id', 'GraphicConfig/ReadGraphicConfig@getGraphicConfigById');

//controllersConfig route
Router::add('GET','/controllersConfig', 'controllersConfig/ReadControllerConfiguration@getAllControllerConfig');
Router::add('GET','/controllersConfig/id', 'controllersConfig/ReadControllerConfiguration@getControllerConfigById');

//device route
Router::add('GET','/devices', 'Device/ReadDevice@getAllDevices');
Router::add('GET','/device/id', 'Device/ReadDevice@getDeviceById');


//file route
Router::add('POST','/files', 'File/CreateImage@addImage');

Router::run();
?>
