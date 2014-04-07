// JavaScript Document
function visibilite(thingId)
{
var targetElement;
targetElement = document.getElementById(thingId) ;
if (targetElement.style.display == "none") {
	targetElement.style.display = "" ;
} else {
	targetElement.style.display = "none";
}
}

function change_icone(thingId,imgId)
{
var targetElement;
var targetImg;
targetElement = document.getElementById(thingId) ;
targetImg = document.getElementById(imgId) ;
if (targetElement.style.display == "none") {
	targetImg.style.background = "url(../image/icon/treeview_m.png)";
} else {
	targetImg.style.background = "url(../image/icon/treeview_p.png)";
}
}

function display(calque)
{
	document.getElementById('calque').style.display=document.getElementById('calque').style.display=="none"?"block":"none";
}


function visibleReset()
{

	var target1;
	target1 = document.getElementById('tab_1') ;
	target1.style.background = "url(../design/pic/tab_a.png)";
	
	var target2;
	target2 = document.getElementById('tab_2') ;
	target2.style.background = "url(../design/pic/tab_d.png)";
	
	var show1;
	show1 = document.getElementById('field_1') ;
	show1.style.display = "";
	
	var show2;
	show2 = document.getElementById('field_2') ;
	show2.style.display = "none";

}

function visible1()
{
var target1;
target1 = document.getElementById('tab_1') ;
target1.style.background = "url(../design/pic/tab_a.png)";
var show1;
show1 = document.getElementById('field_1') ;
show1.style.display = "";

var target2;
target2 = document.getElementById('tab_2') ;
target2.style.background = "url(../design/pic/tab_d.png)";
var show2;
show2 = document.getElementById('field_2') ;
show2.style.display = "none";
}

function visible2()
{
var target1;
target1 = document.getElementById('tab_1') ;
target1.style.background = "url(../design/pic/tab_d.png)";
var show1;
show1 = document.getElementById('field_1') ;
show1.style.display = "none";

var target2;
target2 = document.getElementById('tab_2') ;
target2.style.background = "url(../design/pic/tab_a.png)";
var show2;
show2 = document.getElementById('field_2') ;
show2.style.display = "";
}