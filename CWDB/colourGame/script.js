var hard = document.getElementById("hard");
var easy = document.getElementById("easy");
var reset = document.getElementById("reset");
var difficulty = 6;

hard.addEventListener("click",function(){
    difficulty = 6;
    load();
});

easy.addEventListener("click",function(){
    difficulty = 3;
    load();
});

reset.addEventListener("click",function(){
    load();
});

load();

function load(){

    var text = "";
    for(var i = 0;i<difficulty;i++)
        text += "<div class='square'></div>";
    document.querySelector(".container").innerHTML = text;

    document.querySelector("h1").style.backgroundColor = "steelblue";
    document.getElementById("message").innerHTML = "";

    var colors = [];
    var pickedColour;

    var squares = document.querySelectorAll(".square");

    addColors();
    pickedColor();
    displaySquares();

    function addColors(){
        for(var i=0;i<difficulty;i++)
            colors.push(getRandomColor());
    }

    function displaySquares(){
        if(difficulty === 6){
            document.getElementById("hard").style.backgroundColor = "steelblue";
            document.getElementById("hard").style.color = "#FFFFFF";
            document.getElementById("easy").style.backgroundColor = "#FFFFFF";
            document.getElementById("easy").style.color = "steelblue";
        }else{
            document.getElementById("hard").style.backgroundColor = "#FFFFFF";
            document.getElementById("hard").style.color = "steelblue";
            document.getElementById("easy").style.backgroundColor = "steelblue";
            document.getElementById("easy").style.color = "#FFFFFF";
        }
        for(var i=0;i<difficulty;i++){
            squares[i].style.backgroundColor = colors[i];
            squares[i].addEventListener("click", function(){
                var thisColor = this.style.backgroundColor;
                if(thisColor === pickedColour){
                    document.getElementById("message").innerHTML = "Correct!";
                    changeColor();
                }else{
                    this.style.backgroundColor = "#232323";
                    document.getElementById("message").innerHTML = "Try again!";
                }
            });
        }
    }

    function changeColor(){
        for(var i=0;i<difficulty;i++){
            squares[i].style.backgroundColor = pickedColour;
        }
        document.querySelector("h1").style.backgroundColor = pickedColour;
    }

    function pickedColor(){
        var colorDisplay = document.getElementById("colorDisplay");
        var index = Math.floor((Math.random() * difficulty));
        colorDisplay.innerHTML = colors[index];
        pickedColour =  colors[index];
    }

    function getRandomColor(){
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);
        return "rgb("+r+", "+g+", "+b+")";
    }
}
