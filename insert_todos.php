<?php
	session_start();
		$servername = "sql1.njit.edu";
		$username = "jxs4";
		$password = "PLBIaZdiV";
		$dbname = "jxs4";
			
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		$message = $_POST['message'];
		$duedate = $_POST['duedate'];
		$ownerid = $_SESSION["id"];
		$owneremail = $_SESSION["email"];
		$createddate = date('Y-m-d H:i:s');
		$sql = "INSERT INTO todos (owneremail, ownerid, createddate, duedate, message, isdone) values ('$owneremail', '$ownerid', '$createddate', '$duedate', '$message', 0)";
		$conn->query($sql);
		header("location:homepage.php");
	}
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	</head>
	<body>
		<div class="container" style = 'max-width: 500px; margin-top: 15'>
			<?php
				echo '<span style = "font-size:20; font-weight:500">';
				echo 'Insert a new todo item: <br>';
				echo '</span>';
			?>
			<form class="form" action="insert_todos.php" method="post">
				Message: <input type="text" id = "message" class="form-control" placeholder="Message" name="message">
				Due Date: <input type="date" id = "duedate" class="form-control"  name="duedate">
				<button class="btn btn-primary btn-lg btn-block" type="submit" name="save" value="save">Save</button>
			</form>
		</div>
	</body>
</html>