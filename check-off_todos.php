<?php
	session_start();
		$servername = "sql1.njit.edu";
		$username = "jxs4";
		$password = "PLBIaZdiV";
		$dbname = "jxs4";
			
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($_SERVER['REQUEST_METHOD'] === 'GET'){
		$tid = $_GET['tid'];
		$sql = "UPDATE todos SET isdone = 1 where id = '$tid'";
		$conn->query($sql);
		header("location:homepage.php");
	}
?>