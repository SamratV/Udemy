var start=new Date().getTime();
var bst=-1;
function getColor()
{
	var list=['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F'];
	var color="#";
	for(var i=0;i<6;i++)
		color+=list[Math.floor(Math.random()*16)];
	return color;
}
function makeShapeAppear()
{
	start=new Date().getTime();
	if(Math.random()>0.5)
	{
		document.getElementById("shape").style.borderRadius="50%";
	}
	else
	{
		document.getElementById("shape").style.borderRadius="0%";
	}
	var top=Math.floor(Math.random()*400);
	var left=Math.floor(Math.random()*1200);
	var side=Math.floor(Math.random()*200+100);
	document.getElementById("shape").style.backgroundColor=getColor();
	document.getElementById("shape").style.top=top+"px";
	document.getElementById("shape").style.left=left+"px";
	document.getElementById("shape").style.width=side+"px";
	document.getElementById("shape").style.height=side+"px";
	document.getElementById("shape").style.display="block";
}
function makeDelay()
{
	setTimeout(makeShapeAppear,2000);
}
document.getElementById("shape").onclick=function()
{
	document.getElementById("shape").style.display="none";
	var end=new Date().getTime();
	var duration=(end-start)/1000;
	if(bst==-1 || bst>duration)
		bst=duration;
	document.getElementById("best").innerHTML="Best: "+bst+"s";
	document.getElementById("rt").innerHTML="Your reaction time: "+duration+"s";
	makeDelay();
}