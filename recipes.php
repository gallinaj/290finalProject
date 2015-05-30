<?php
error_reporting(E_ALL);
ini_set('display_errors','On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "gallinaj-db", $myPassword, "gallinaj-db");

if($mysqli->connect_errno) {
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else {
//	echo "Connection worked!<br />";
	
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

    if(!($mysqli->query($table))) {
        echo $table.'<br />' . $mysqli->error;
    }
    /*** close connection ***/
  //  $mysqli->close();
}
?>