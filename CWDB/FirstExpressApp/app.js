var express = require("express");
var app = express();

app.set("view engine",".ejs");
app.use(express.static("public"));

// Routes
app.get("/",function(req, res){
    console.log("HOME");
    //res.send("Hi there!");
    res.render("home");
});

app.get("/bye",function(req, res){
    console.log("BYE");
    res.send("Goodbye!");
});

app.get("/r/:path_var_1",function(req, res){
    var params = req.params;
    res.send("Welcome to: "+params.path_var_1.toUpperCase());
});

app.get("/r/:path_var_1/p/:path_var_2",function(req, res){
    var params = req.params;
    res.send("Welcome to: "+params.path_var_1.toUpperCase()+" -> "+params.path_var_2.toUpperCase());
});

app.get("*",function(req, res){ /* Order of routes matter. Hence, use this code at last as it handles all routes. */
    res.send("Page doesn't exists.");
});

app.listen(1234,function(){
    console.log("First express app listening at http://127.0.0.1:1234");
});
