var express = require("express");
var app = express();
var bodyParser = require("body-parser");
var mongoose = require("mongoose");

mongoose.connect("mongodb://localhost/yelpcamp");

app.set("view engine",".ejs");
app.use(bodyParser.urlencoded({extended: true}));

// Schema
var campgroundSchema = new mongoose.Schema({
    name: String,
    image: String,
    description: String
});
var Campground = mongoose.model("Campground", campgroundSchema);
// Campground.create(
//     {
//         name: "Mountain creek",
//         image: "1.jpg",
//         description: "Awesome mountain camp."
//     },
//     function(err, res){
//         if(err)
//             console.log(err);
//         else
//             console.log(res);
// });

// Routes
app.get("/", function(req, res){
    res.render("landing");
});

app.get("/campgrounds", function(req, res){
    Campground.find({},function(err, campgrounds){
        if(err)
            console.log(err);
        else
            res.render("index",{campgrounds: campgrounds});
    });
});

app.post("/campgrounds", function(req, res){
    var name = req.body.name;
    var image = req.body.image;
    var description = req.body.description;
    var newCampground = {name: name, image: image, description: description};
    Campground.create(
        newCampground,
        function(err, res){
            if(err)
                console.log(err);
            else
                console.log(res);
    });
    res.redirect("/campgrounds");
});

app.get("/campgrounds/new", function(req, res){
    res.render("new");
});

app.get("/campgrounds/:id", function(req, res){
    Campground.findById(req.params.id, function(err, foundCampground){
        if(err)
            console.log(err);
        else
            res.render("show", {campground: foundCampground});
    });
});

// Listen
app.listen(1234, function(){
    console.log("Go to http://127.0.0.1:1234");
});
