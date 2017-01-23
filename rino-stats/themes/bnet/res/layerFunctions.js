//Show layer//
function showLayer(layerName){
	
	obj = document.getElementById(layerName);
	obj.style.visibility="visible";

}

//Hide layer//
function hideLayer(layerName){

	obj = document.getElementById(layerName);
	obj.style.visibility="hidden";

}

function regainFocus() {

	opener.focus();

	window.focus();

}

function windowFinisher(url) {

	if ((opener.location.href != "http://www.battle.net/war3/human/buildings.shtml") && 
	    (opener.location.href != "http://www.battle.net/war3/orc/buildings.shtml") && 
		(opener.location.href != "http://www.battle.net/war3/nightelf/buildings.shtml") && 
		(opener.location.href != "http://www.battle.net/war3/undead/buildings.shtml")) {
	
	
		opener.location.href = url;
		
		regainFocus();
		
		window.close();
	
	} else {
		
		opener.focus();
		
		window.close();	
	
	}

}