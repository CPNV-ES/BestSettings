Element.prototype.addElement = function(type, classlist){
    var elem = document.createElement(type);
    elem.classList = classlist;
    this.appendChild(elem);
    return elem;
}
$.ajax({
    url: 'http://127.0.0.1:8000/games',
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
            var url = "http://127.0.0.1:8000"+element.logo;
            divImg.style.backgroundImage ="url("+url+")"
            var divBody = divGrow.addElement('div', 'card-body');
            var h5 = divBody.addElement('h5', 'card-title');
            h5.innerText = element.name;
            var divInfo = divBody.addElement('div', 'infos');
            });
    },
    type: 'GET'
    });