<?php
	$_POST = array();
	session_start();
	if (!isset($_SESSION["email"])){
		header("location:sign_in.php");
	}
		$servername = "sql1.njit.edu";
		$username = "jxs4";
		$password = "PLBIaZdiV";
		$dbname = "jxs4";

	$email = $_SESSION["email"];

	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	$info = array();
	$info['welcome'] = "Welcome, ". $_SESSION["fname"]. " ". $_SESSION["lname"]. "!";

	$sql = "SELECT * FROM todos where owneremail = '$email' and isdone = 1 order by createddate";
	$todos_1 = $conn->query($sql);
	
	if ($todos_1->num_rows == 0) {
	    $info['no complete'] = 1;
	} 

	$sql = "SELECT * FROM todos where owneremail = '$email' and isdone = 0 order by createddate";
	$todos_0 = $conn->query($sql);
	
	if ($todos_0->num_rows == 0) {
	    $info['no incomplete'] = 1;
	} 

	

?>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Home Page</title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>

	<body>
		<div class="container">
			<?php
				if (isset($info)){
					echo '<span style = "font-size:20; font-weight:500">';
					echo $info['welcome'];
					echo '</span>';
					echo '<br>';
				}
				echo '<button class="btn-insert btn btn-warning">Add a new todo item</button> <br>';
				echo "<table class='table'><tr><th colspan = 5>Todo Items</th></tr>";
				echo '<tr class = "table-info"><td>ID</td><td>Message</td><td>Create Date</td><td>Due Date</td><td>Actions</td></tr>';
				while($row = $todos_0->fetch_assoc()){
					echo "<tr><td>".$row["id"]."</td><td>".$row["message"]."</td><td>".$row["createddate"]."</td><td>".$row["duedate"]."</td><td>".'<button class="btn-edit btn btn-info" value='.$row["id"].'>Edit</button>'.'<button class="btn-delete btn btn-danger" value='.$row["id"].'>Delete</button>'.'<button class="btn-checkoff btn btn-success" value='.$row["id"].'>Check-Off</button>'."</td></tr>";
				}
				echo "<table class='table'><tr><th colspan = 5>Completed Todo Items</th></tr>";
				echo "<tr class = 'table-success'><td>ID</td><td>Message</td><td>Create Date</td><td>Due Date</td><td>Actions</td></tr>";
				while($row = $todos_1->fetch_assoc()){
					echo "<tr><td>".$row["id"]."</td><td>".$row["message"]."</td><td>".$row["createddate"]."</td><td>".$row["duedate"]."</td><td>".'<button class="btn-edit btn btn-info" value='.$row["id"].'>Edit</button>'.'<button class="btn-delete btn btn-danger" value='.$row["id"].'>Delete</button>'."</td></tr>";
				}

			?>

		</div> <!-- /container -->
	</body>
	<script>
		$(document).ready(function(){
    		$(".btn-edit").click(function(event){
        		tid = $(event.target).val();
        		window.location.href = 'edit_todos.php?tid=' + tid;
    		});
    		$(".btn-delete").click(function(event){
        		tid = $(event.target).val();
        		window.location.href = 'delete_todos.php?tid=' + tid;
    		});
    		$(".btn-checkoff").click(function(event){
        		tid = $(event.target).val();
        		window.location.href = 'check-off_todos.php?tid=' + tid;
    		});
    		$(".btn-insert").click(function(event){
        		window.location.href = 'insert_todos.php?';
    		});
		});
	</script>
</html>