/*** Stuff that will be present when the HTML loads***/
window.onload = function() {
	makeRequest("action=initialize");
	
	document.getElementById("addButton").addEventListener("click", addRecipe);
	document.getElementById("sortOnType").addEventListener("click", sortRecipeType);
	document.getElementById("sortOnIng").addEventListener("click", sortRecipeIng);
	
	document.getElementById("sortOnIng").addEventListener("click", sortRecipeIng);
	
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
		
		statement +="&name=" + element.elements["name"].value;
		statement +="&category=" + element.elements["category"].value;
		statement +="&mainIngredient=" + element.elements["mainIngredient"].value;
		statement +="&location=" + element.elements["location"].value;
	}
	
	var sortBy = "sortBy=" + localStorage.getItem("sortBy");
	statement += '&' + sortBy;
	
	xmlHttp.open("GET", "recipes.php?" + statement, true);
	xmlHttp.send();		
}

function addRecipe() {
	var statement = "action=add";
	makeRequest(statement);
}

function sortRecipeType() {
	localStorage.setItem("sortBy", "category");
	var statement = "action=sort";
	makeRequest(statement);	
}

function sortRecipeIng() {
	localStorage.setItem("sortBy", "mainIngredient");
	var statement = "action=sort";
	makeRequest(statement);	
}

function removeRecipe() {
	var statement = "action=remove&id=" + this.parentNode.id;
	makeRequest(statement);
}