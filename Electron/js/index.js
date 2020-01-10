window.$ = window.jQuery = require('jquery');

$.ajax({
    url: 'http://127.0.0.1:8000/Game',
    data: '',
    error: function() {
        document.getElementById("error").innerText="An error has occurred";
    },
    dataType: 'json',
    success: function(data) {
        var table = document.getElementById("tablegame");
        data.forEach(element => {
            var img = document.createElement("img")
            img.src = "http://127.0.0.1:8000/"+element.logo;
            img.height = 300;
            img.width = 200;
            var tdname = document.createElement("td");
            var tdlogo = document.createElement("td");
            var tr = document.createElement("tr");
            table.appendChild(tr);
            tdname.innerText = element.name;
            tr.appendChild(tdname);
            tdlogo.appendChild(img);
            tr.appendChild(tdlogo);
            });
        
    },
    type: 'GET'
    });