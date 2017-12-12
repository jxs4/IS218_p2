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
		$_SESSION["tid"] = $tid;
		$sql = "SELECT * FROM todos where id = '$tid'";
		$result = $conn->query($sql);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		$message = $_POST['message'];
		$duedate = $_POST['duedate'];
		$tid = $_SESSION["tid"];
		$sql = "UPDATE todos SET message = '$message', duedate = '$duedate' where id = '$tid'";
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
				echo 'Edit Todo Item #'.$tid.': <br>';
				echo '</span>';
				$message = '';
				$due_date = '';
				while($row = mysqli_fetch_assoc($result)){
					$message = $row['message'];
					$due_date = $row['duedate'];
				}
				echo 'Current Message: '.$message. '<br>';
				echo 'Current Due Date: '.$due_date. '<br>';
			?>
			<form class="form-signin" action="edit_todos.php" method="post">
				New Message: <input type="text" id = "message" class="form-control" placeholder="New Message" name="message">
				New Due Date: <input type="date" id = "duedate" class="form-control"  name="duedate">
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="save" value="save">Save</button>
			</form>
		</div>
	</body>
</html>