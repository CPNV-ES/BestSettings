window.addEventListener('load', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const ipc = require('electron').ipcRenderer;
    let serveur = ipc.sendSync('serveur');
    const id = urlParams.get('id');

    Element.prototype.addElement = function (type, classlist) {
        var elem = document.createElement(type);
        elem.classList = classlist;
        this.appendChild(elem);
        return elem;
    }

    $.ajax({
        url: serveur + '/game/' + id,
        data: '',
        error: function () {
            document.getElementById("error").innerText = "An error has occurred";
        },
        dataType: 'json',
        success: function (data) {
            AddInformationGame(data);
            AddTableGraphic(data);
            AddTableSettings(data);
        },
        type: 'GET'
    });

    function AddInformationGame(data) {
        var divContainLogo = gameInfo.addElement('div', 'col-4');
        var divLogo = divContainLogo.addElement('div', 'gameLogo');
        var url = serveur + data.logo;
        divLogo.style.backgroundImage = "url(" + url + ")";
        var divGameInfo = gameInfo.addElement('div', 'col-6 mt-2 float-right');
        data.gamesCategories.forEach(element => {
            var divCategory = divGameInfo.addElement('div', 'col-6');
            divCategory.innerText = element.name;
            var img = divCategory.addElement('img', 'categoryLogo pl-2');
            var url = serveur + element.logo;
            img.src = url;
            img.width = "24";
            img.height = "24";
        });
        data.platforms.forEach(element => {
            var divPlatform = divGameInfo.addElement('div', 'col-6');
            divPlatform.innerText = element.name;
            var img = divPlatform.addElement('img', 'platform pl-2');
            var url = serveur + element.logo;
            img.src = url;
            img.width = "24";
            img.height = "24";
        });
        gameInfo.addElement('hr');
        document.getElementById("gameInfo");
    }

    function AddTableGraphic(data) {
        if (data.gameConfigurations.length > 0) {
            if (data.gameConfigurations[0].graphicsConfigs) {
                settings = data.gameConfigurations[0].graphicsConfigs.settings[0];
                row = createRowGraphics(settings);
                Object.keys(row).forEach(key => {
                    data = row[key];
                    var tr = graphicsettings.addElement('tr');
                    var td = tr.addElement('td');
                    td.innerText = key;
                    Object.keys(data).forEach(key => {

                        var td = tr.addElement('td');
                        td.innerText = data[key];
                    });
                });
            }
        }
    }

    function AddTableSettings(data) {
        if (data.gameConfigurations.length > 0) {
            if (data.gameConfigurations[0].controllersConfigs) {
                device = data.gameConfigurations[0].controllersConfigs;
                device.forEach(element => {
                    settings = element.settings;
                    row = createRowsettings(settings);
                    var table = controllersettings.addElement('table', 'table table-dark table-striped');
                    var thead = table.addElement('thead');
                    var tr = thead.addElement('tr');
                    var thparams = tr.addElement('th')
                    thparams.innerText = "Action";
                    var thdevice = tr.addElement('th')
                    thdevice.innerText = element.deviceId.name;
                    var tbody = table.addElement('tbody');
                    var tr = tbody.addElement('tr');
                    Object.keys(row).forEach(key => {
                        data = row[key];
                        var tr = tbody.addElement('tr');
                        var td = tr.addElement('td');
                        td.innerText = key;
                        Object.keys(data).forEach(key => {

                            var td = tr.addElement('td');
                            td.innerText = data[key];
                        });
                    });
                });
            }
        }
    }

    function createRowGraphics(settings) {
        var parameter = {};
        Object.keys(settings).forEach(key => {
            params = settings[key][0];
            Object.keys(params).forEach(key => {
                if (parameter[key] == null) {
                    parameter[key] = [];
                }
                parameter[key].push(params[key]);
            });
        });
        return parameter;
    }
    function createRowsettings(settings) {
        var parameter = {};
        settings.forEach(element => {
            Object.keys(element).forEach(key => {
                if (parameter[key] == null) {
                    parameter[key] = [];
                }
                parameter[key].push(element[key]);
            });
        });
        return parameter;
    }

    $.ajax({
        url: serveur + '/categories',
        data: '',
        error: function () {
            document.getElementById("error").innerText = "An error has occurred";
        },
        dataType: 'json',
        success: function (data) {
            data.forEach(element => {
                var a = menuContent.addElement('a', '');
                a.href = "";
                a.innerText = element.name;
            });
        },
        type: 'GET'
    });
})
