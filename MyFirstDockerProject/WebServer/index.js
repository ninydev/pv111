const http = require("http");

http.createServer(
    function(
                    request,
                    response){
    response.end("<h1>Hello World from container</h1>");
}).listen(80);
