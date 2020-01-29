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
    settings = data.gameConfigurations[0].graphicsConfigs.settings[0];
    row = createRow(settings);
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

    /*<tr>
        <td>Resolution</td>
        <td>1920x1080</td>
        <td>1920x1080</td>
    </tr>*/
}

function AddTableSettings(data) {

}

function createRow(settings) {
    var parameter = {};
    var keys = Object.keys(settings);
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