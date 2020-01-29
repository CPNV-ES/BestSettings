const ipc = require('electron').ipcRenderer;
const electron = require('electron')
let serveur = ipc.sendSync('serveur');
const BrowserWindow = electron.remote.BrowserWindow;

window.$ = window.jQuery = require('jquery');
addGames();
Element.prototype.addElement = function (type, classlist) {
    var elem = document.createElement(type);
    elem.classList = classlist;
    this.appendChild(elem);
    return elem;
}
function addGames() {
    $.ajax({
        url: serveur + '/games',
        data: '',
        error: function () {
            document.getElementById("error").innerText = "An error has occurred";
        },
        dataType: 'json',
        success: function (data) {
            data.forEach(element => {
                var a = games.addElement('a', '');
                a.href = "gameDetails.html?id=" + element._id.$oid;
                var divGrow = a.addElement('div', 'card grow');
                var divImg = divGrow.addElement('div', 'card-img');
                var url = serveur + element.card;
                divImg.style.backgroundImage = "url(" + url + ")"
                var divBody = divGrow.addElement('div', 'card-body');
                var h5 = divBody.addElement('h5', 'card-title');
                h5.innerText = element.name;
                var divInfo = divBody.addElement('div', 'infos');
            });
        },
        type: 'GET'
    });
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
            var option = categories.addElement('option');
            option.innerText = element.name;
            option.value = element._id.$oid;
        });
    },
    type: 'GET'
});
$.ajax({
    url: serveur + '/platforms',
    data: '',
    error: function () {
        document.getElementById("error").innerText = "An error has occurred";
    },
    dataType: 'json',
    success: function (data) {
        data.forEach(element => {
            var option = plateform.addElement('option');
            option.innerText = element.name;
            option.value = element._id.$oid;
        });
    },
    type: 'GET'
});

submit.addEventListener("click", function () {
    name = gameName.value;
    logo = "/Image/" + logoname.files[0].name;
    card = "/Image/" + cardname.files[0].name;
    console.log(card);
    gameCategoryId = categories.value;
    plateformId = plateform.value;
    json = { "name": name, "logo": logo, "card": card, "platforms": [{ plateformId }], "gamesCategories": [{ gameCategoryId }], "gameConfigurations": [{}] };
    console.log(json);
    var File = new FormData();
    File.append('card', cardname.files[0]);
    File.append('logo', logoname.files[0]);
    $.ajax({
        url: serveur + '/files',
        data: File,
        type: 'POST',
        contentType: false,
        processData: false,
        error: function () {
            document.getElementById("error").innerText = "An error has occurred";
        },
        success: function () {
        },
    });
    $.ajax({
        url: serveur + '/games',
        data: JSON.stringify(json),
        type: 'POST',
        error: function () {
            document.getElementById("error").innerText = "An error has occurred";
        },
        success: function () {
            games.innerHTML = "";
            addGames();
        },
    });
});
