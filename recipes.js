window.onload = function() {
	makeRequest("action=initial");
	
	document.getElementById("addButton").addEventListener("click", addRecipe);
}


function makeRequest(statement) {
	var xmlHttp;
	
	//Checks version of browser
	if(window.XMLHttpRequest) {		//For Mozilla, Safari, IE7+
		xmlHttp = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {		//For IE6 and older
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}	
	if(!xmlHttp){
		alert ("Unable to create HTTPRequest.");
	}

	xmlHttp.onreadystatechange = function() {
		if(xmlHttp.readyState == 4) {
			if(xmlHttp.status == 200) {
				var response = xmlHttp.responseText;
				var elem = document.getElementById("recipeList");
				elem.innerHTML = response;
				
			}
		}
	}
	
	if(statement == "action=add") {
		var element = document.getElementById("addForm");
		
		statement +="&name" + element.elements["name"].value;
		statement +="&type" + element.elements["type"].value;
		statement +="&mainIngredient" + element.elements["mainIngredient"].value;
		statement +="&location" + element.elements["location"].value;
		
	}
	
	//statement += "&";
	
	xmlHttp.open("GET", "recipes.php?" + statement, true);
	xmlHttp.send();		
}

function addRecipe() {
	var statement = "action=add";
	makeRequest(statement);
}