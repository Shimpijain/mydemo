<?php
	$host="localhost:3306";
	$username="root";
	$password="";
	$db="mydb";
	$conn= mysqli_connect($host,$username,$password,$db);
	if (!$conn) {
		die("".mysqli_connect_error());
	}
?>
