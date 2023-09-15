<?php 
	define("Dbhost", "localhost");
	define("Dbuser", "root");
	define("Dbpass", "");
	define("Dbname", "databasescript");

	$con = new mysqli(Dbhost,Dbuser,Dbpass,Dbname);
	error_reporting(E_ALL ^ E_WARNING); 
	if ($con->connect_error) {
		die("Could not Connect to Database");
	}
?>