<?php
/*error_reporting(E_ALL);
ini_set('display_errors','On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gallinaj-db", $myPassword, "gallinaj-db");

if($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {*/
	//echo "Connection worked!<br />";
	
	/***Code assistance from http://www.phpro.org/tutorials/Introduction-to-PHP-and-MySQL.html#6.2
	and CS340 video on PHP and MySQL***/
	
    /*** sql to create a new table if it doesn't already exist ***/
    /*$table = "CREATE TABLE IF NOT EXISTS recipes (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	category VARCHAR(255),
	mainIngredient VARCHAR(255),
	location VARCHAR(255),
	PRIMARY KEY (id)
	)";*/
	require_once 'recipeHeader.php';

	$table = 'recipes';

	/*** Initial display of table ***/
	function initialize() {
		global $mysqli, $table;
		$id_result = $_SESSION['mem_id'];
		
		if (!($stmt = $mysqli->prepare("SELECT * FROM $table WHERE mem_id = '$id_result'"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!($allResults = $stmt->get_result())) {
			echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		//$allResults = $stmt->get_result();
		
		buildTable($allResults);
		
		$stmt->close();
	}

	
	function buildTable($allResults) {
		echo "<table border=\"1px\">";
		//echo "<caption>Recipe List</caption>";
			echo "<thead>";
				echo "<th>Recipe Name</th>";
				echo "<th>Type</th>";
				echo "<th>Main Ingredient</th>";
				echo "<th>Location</th>";
			echo "</thead>";
			echo "<tbody>";

				while($row = $allResults->fetch_assoc())
				{
					echo "<tr id=\"" . $row["id"] . "\">";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td class=\"category\">" . $row["category"] . "</td>";
					echo "<td>" . $row["mainIngredient"] . "</td>";
					echo "<td>" . $row["location"] . "</td>";
					//echo "<td>" . $row["loc_details"] . "</td>";
					//echo "<td class=\"update\">Update</td>";
					//echo "<td><input class=\"remove\" type=\"button\" name=\"remove\" value=\"Remove\"></td>";
					echo "</tr>";
				}
			echo "</tbody>";
		echo "</table>";  
	}
	
	function addRecipe($name, $category, $mainIngredient, $location, $loc_details) {
		global $mysqli, $table;
		$id_result = $_SESSION['mem_id'];
		
/*		if($location == "website") {
			echo "<span>URL </span><input type=\"url\" name=\"recipeSite\"><br />";
		}*/
		
		if(!($stmt = $mysqli->prepare("INSERT INTO $table(name, category, mainIngredient, location, loc_details, mem_id) VALUES(?,?,?,?,?,?)"))) {
			echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if(!$stmt->bind_param("sssssi", $name, $category, $mainIngredient, $location, $loc_details, $id_result)) {
			echo "Bind failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if(!$stmt->execute()) {
			echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		else {
			echo "Added " . $name . " to Recipe Box.";
		}
		
		initialize();
		
		$stmt->close();
	}
	
	function sortRecipe($sortBy) {
		global $mysqli, $table;
		$id_result = $_SESSION['mem_id'];
		
		if(!($stmt = $mysqli->prepare("SELECT * FROM $table WHERE mem_id = '$id_result' ORDER BY $sortBy"))) {
			echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if(!$stmt->execute()) {
			echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if (!($allResults = $stmt->get_result())) {
			echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		buildTable($allResults);		

		$stmt->close();	
	}
	
	function filterRecipe($filterBy, $filterOn) {
		global $mysqli, $table;
		$id_result = $_SESSION['mem_id'];
		
		if(!($stmt = $mysqli->prepare("SELECT * FROM $table WHERE mem_id = '$id_result' AND $filterBy LIKE '%$filterOn%'"))) {
			echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if(!$stmt->execute()) {
			echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if (!($allResults = $stmt->get_result())) {
			echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}		
		
		buildTable($allResults);		

		$stmt->close();	
	}

	function removeRecipe($id) {
		global $mysqli, $table;
		$id_result = $_SESSION['mem_id'];

		if(!($stmt = $mysqli->prepare("DELETE FROM $table WHERE mem_id = '$id_result' AND id = ?"))) {
			echo "Prepare failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		if(!$stmt->bind_param("i", $id)) {
			echo "Bind failed: "  . $mysqli->errno . " " . $mysqli->error;
		}		
		if(!$stmt->execute()) {
			echo "Execute failed: "  . $mysqli->errno . " " . $mysqli->error;
		}
		initialize();

		$stmt->close();	
	}
	
	function viewAll() {
		global $mysqli, $table;
		
		if (!($stmt = $mysqli->prepare("SELECT * FROM $table"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!($allResults = $stmt->get_result())) {
			echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		buildTable($allResults);
		
		$stmt->close();
	}	
	
	/*** Check if an action was sent ***/
	if(isset($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		
		if($action == 'initialize') {
			initialize();
		}
		elseif($action == 'add') {
			$name = $_REQUEST['name'];
			$category = $_REQUEST['category'];
			$mainIngredient = $_REQUEST['mainIngredient'];
			$location = $_REQUEST['location'];
			$loc_details = $_REQUEST['loc_details'];
			addRecipe($name, $category, $mainIngredient, $location, $loc_details);
		}
		elseif($action == 'sort') {
			$sortBy = $_REQUEST['sortBy'];
			sortRecipe($sortBy);			
		}
		elseif($action == 'filter') {
			$filterBy = $_REQUEST['filterBy'];
			$filterOn = $_REQUEST['filterOn'];
			filterRecipe($filterBy, $filterOn);			
		}
		elseif($action == 'remove') {
			$id = $_REQUEST['id'];
			removeRecipe($id);
		}
		elseif($action == 'viewAll') {
			viewAll();
		}
	}	

//}
?>