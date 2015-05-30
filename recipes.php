<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gallinaj-db", $myPassword, "gallinaj-db");

if($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
	echo "Connection worked!<br />";
	
	/***Code assistance from http://www.phpro.org/tutorials/Introduction-to-PHP-and-MySQL.html#6.2
	and CS340 video on PHP and MySQL***/
	
    /*** sql to create a new table ***/
    $table = "CREATE TABLE IF NOT EXISTS recipes (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL UNIQUE,
	category VARCHAR(255),
	mainIngredient VARCHAR(255),
	location VARCHAR(255),
	PRIMARY KEY (id)
	)";

    /*if(!($mysqli->query($table))) {
        echo $table.'<br />' . $mysqli->error;
    }*/
	
	function initial() {
		global $mysqli, $table;
		
		if (!($stmt = $mysqli->prepare("SELECT * FROM $table"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		/*if (!($allResults = $stmt->get_result())) {
			echo "Get results failed: (" . $mysqli->errno . ") " . $mysqli->error;
		})*/
		$allResults = $stmt->get_result();
		
		buildTable($allResults);
		
		$stmt->close();
	}
	
	function buildTable($results) {
		echo "<table border=\"1px\">";
		echo "<caption>Recipe List</caption>";
			echo "<thead>";
				echo "<th>Recipe Name</th>";
				echo "<th>Type</th>";
				echo "<th>Main Ingredient</th>";
				echo "<th>Location</th>";
			echo "</thead>";
			echo "<tbody>";
/*			
				echo "<tr>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $category . "</td>";
				echo "<td>" . $length . "</td>";

							
				echo "</tr>"; 

					$stmt->close();
*/
				while($row = $results->fetch_assoc())
				{
					echo "<tr id=\"" . $row["id"] . "\"";
					echo "<td>" . $row["name"] . "</td>";
					echo "<td>" . $row["category"] . "</td>";
					echo "<td>" . $row["mainIngredient"] . "</td>";
					echo "<td>" . $row["location"] . "</td>";
					echo "<td class=\"update\">Update</td>";
					echo "<td class=\"remove\">Remove</td>";
					echo "</tr>";
				}
			echo "</tbody>";
		echo "</table>";  
	}
    /*** close connection ***/
  //  $mysqli->close();
}
?>