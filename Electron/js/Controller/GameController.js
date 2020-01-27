const ipc = require('electron').ipcRenderer; 
const electron = require('electron')
let serveur = ipc.sendSync('serveur');
const BrowserWindow = electron.remote.BrowserWindow;

HTMLCollection.prototype.forEach = Array.prototype.forEach;

Element.prototype.addElement = function(type, classlist){
    var elem = document.createElement(type);
    elem.classList = classlist;
    this.appendChild(elem);
    return elem;
}

$.ajax({
    url: serveur+'/games',
    data: '',
    error: function() {
        document.getElementById("error").innerText="An error has occurred";
    },
    dataType: 'json',
    success: function(data) {
        data.forEach(element => {
            var a = games.addElement('a', '');
            a.setAttribute('data-id', element._id.$oid)
            var divGrow = a.addElement('div', 'card grow');
            var divImg = divGrow.addElement('div', 'card-img');
            var url = serveur+element.card;
            divImg.style.backgroundImage ="url("+url+")"
            var divBody = divGrow.addElement('div', 'card-body');
            var h5 = divBody.addElement('h5', 'card-title');
            h5.innerText = element.name;
            var divInfo = divBody.addElement('div', 'infos');
            });
        document.getElementsByTagName('a').forEach(function (elem) {
            elem.addEventListener("click", sendId);
        });
    },
    type: 'GET'
});

function sendId(elem){
    data = elem.path[2].dataset.id;
    let win = new BrowserWindow({width: 900, height: 600, webPreferences: { nodeIntegration: true}});
    win.on('close', function () { win = null })
    win.loadFile('./views/gameDetails.html', {query: {"data": JSON.stringify(data)}})
    win.show()
}