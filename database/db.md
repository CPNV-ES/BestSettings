    10.01.2020 - UML1 - Projet

# Data base : bestsettings

## Collections

### games
    _id
    name
    logo (path)
    platformsId (_id)
    gamesCategoriesId (_id)
    configurationsId (_id)

### gamesCategories
games categories

    _id
    name
    logo (path)

### platforms
games platforms

    _id
    name
    logo (path)

### devices
gaming devices (keyboards, controllers...)

    _id
    name
    logo (path)


### configurations
all the configuration for the graphics settings and devices settings

    _id
    graphicsConfigId (_id)
    controllersConfigId (_id)
    keyboardsConfigId (_id)

#### graphicsConfig

    _id
    settings


#### controllersConfig
ps4 & xbox

    _id
    settings
    drivers
    deviceId (_id)

#### keyboardsConfig
layout (azerty, qwertz, qwerty)

    _id
    settings
    deviceId (_id)

