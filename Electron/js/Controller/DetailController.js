const querystring = require('querystring');
let query = querystring.parse(global.location.search);
let data = JSON.parse(query['?data'])
console.log(data);
