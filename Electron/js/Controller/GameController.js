const ipc = require('electron').ipcRenderer; 
let serveur = ipc.sendSync('serveur');

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
            a.href = "";
            var divGrow = a.addElement('div', 'card grow');
            var divImg = divGrow.addElement('div', 'card-img');
            var url = serveur+element.card;
            divImg.style.backgroundImage ="url("+url+")"
            var divBody = divGrow.addElement('div', 'card-body');
            var h5 = divBody.addElement('h5', 'card-title');
            h5.innerText = element.name;
            var divInfo = divBody.addElement('div', 'infos');
            });
    },
    type: 'GET'
    });