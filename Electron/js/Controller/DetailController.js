const urlParams = new URLSearchParams(window.location.search);
const ipc = require('electron').ipcRenderer; 
let serveur = ipc.sendSync('serveur');
const id = urlParams.get('id');

Element.prototype.addElement = function(type, classlist){
    var elem = document.createElement(type);
    elem.classList = classlist;
    this.appendChild(elem);
    return elem;
}

$.ajax({
    url: serveur+'/game/'+id,
    data: '',
    error: function() {
        document.getElementById("error").innerText="An error has occurred";
    },
    dataType: 'json',
    success: function(data) {
        AddInformationGame(data);
    },
    type: 'GET'
});

function AddInformationGame(data){
    var divContainLogo = gameInfo.addElement('div','col-4');
    var divLogo = divContainLogo.addElement('div','gameLogo');
    var url = serveur+data.logo;
    divLogo.style.backgroundImage ="url("+url+")";
    var divGameInfo = gameInfo.addElement('div','col-6 mt-2 float-right');
    data.gameCategories.forEach(element => {
        var divCategory = divGameInfo.addElement('div','col-6');
        divCategory.innerText = element.name;
        var img = divCategory.addElement('img','categoryLogo pl-2');
        var url = serveur+element.logo;
        img.src= url;
        img.width = "24";
        img.height = "24";
    });
    data.platforms.forEach(element => {
        var divPlatform = divGameInfo.addElement('div','col-6');
        divPlatform.innerText = element.name;
        var img = divPlatform.addElement('img','platform pl-2');
        var url = serveur+element.logo;
        img.src= url;
        img.width = "24";
        img.height = "24";
    });
    gameInfo.addElement('hr');
    document.getElementById("gameInfo");
}