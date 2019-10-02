var circle = document.getElementsByClassName("circle");


for (var i = 0; i < circle.length; i++) {
	if(circle[i].innerHTML == "A"){
		$("#spanPoint"+i).css("border-color","#58d8a3") ;
		$("#spanPoint"+i).css("background-color","#58d8a3") ;
	}
	else if(circle[i].innerHTML == "C"){
		$("#spanPoint"+i).css("border-color","#ffaf00") ;
		$("#spanPoint"+i).css("background-color","#ffaf00") ;
	}
	else if(circle[i].innerHTML == "G"){
		$("#spanPoint"+i).css("border-color","#B9062F") ;
		$("#spanPoint"+i).css("background-color","#B9062F") ;
	}
	else if(circle[i].innerHTML == "T"){
		$("#spanPoint"+i).css("border-color","#2196f3") ;
		$("#spanPoint"+i).css("background-color","#2196f3") ;
	}
	else if(circle[i].innerHTML == "A,T"){
		$("#spanPoint"+i).css("border-color","#8A2BE2") ;
		$("#spanPoint"+i).css("background-color","#8A2BE2") ;
	}
	else if(circle[i].innerHTML == "A,C"){
		$("#spanPoint"+i).css("border-color","#7FFF00") ;
		$("#spanPoint"+i).css("background-color","#7FFF00") ;
	}
	else if(circle[i].innerHTML == "A,G"){
		$("#spanPoint"+i).css("border-color","#A52A2A") ;
		$("#spanPoint"+i).css("background-color","#A52A2A") ;
	}
	else if(circle[i].innerHTML == "T,C"){
		$("#spanPoint"+i).css("border-color","green") ;
		$("#spanPoint"+i).css("background-color","green") ;
	}

	else if(circle[i].innerHTML == "T,G"){
		$("#spanPoint"+i).css("border-color","cyan") ;
		$("#spanPoint"+i).css("background-color","cyan") ;
	}
	else if(circle[i].innerHTML == "C,G"){
		$("#spanPoint"+i).css("border-color","#FF1493") ;
		$("#spanPoint"+i).css("background-color","#FF1493") ;
	}
	else if(circle[i].innerHTML == "A,T,C"){
		$("#spanPoint"+i).css("border-color","#CD5C5C") ;
		$("#spanPoint"+i).css("background-color","#CD5C5C") ;
	}
	else if(circle[i].innerHTML == "A,T,G"){
		$("#spanPoint"+i).css("border-color","#F0E68C") ;
		$("#spanPoint"+i).css("background-color","#F0E68C") ;
	}
	else if(circle[i].innerHTML == "A,C,G"){
		$("#spanPoint"+i).css("border-color","#ADD8E6") ;
		$("#spanPoint"+i).css("background-color","#ADD8E6") ;
	}
	else if(circle[i].innerHTML == "T,C,G"){
		$("#spanPoint"+i).css("border-color","#FF4500") ;
		$("#spanPoint"+i).css("background-color","#FF4500") ;
	}
	else if(circle[i].innerHTML == "A,T,C,G"){
		$("#spanPoint"+i).css("border-color","#EE82EE") ;
		$("#spanPoint"+i).css("background-color","#EE82EE") ;
	}
	else
	{
		$("#spanPoint"+i).css("border-color","#8ba2b5") ;
		$("#spanPoint"+i).css("background-color","#8ba2b5") ;
	}

}