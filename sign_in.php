<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		if (isset($_POST['sign_in'])){
			session_start();
			$email = $_POST['email'];
			$password = $_POST['password'];
			
		$servername = "sql1.njit.edu";
		$username = "jxs4";
		$password = "PLBIaZdiV";
		$dbname = "jxs4";
		
			//Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			$sql = "SELECT * FROM accounts where email = '$email'";
			$result = $conn->query($sql);
			$info = "";
			if ($result->num_rows == 0) {
	    		$info = "Email address does not exist.";
			} 
			else{
				while($row = mysqli_fetch_assoc($result)){
					$real_password = $row['password'];
					if($real_password != $_POST['password']){
						$info = "Incorrect password. Please try again.";
					}
					else{
						$_SESSION["fname"] = $row['fname'];
						$_SESSION["lname"] = $row['lname'];
						$_SESSION["email"] = $row['email'];
						$_SESSION["id"] = $row['id'];
						header("location:homepage.php");
					}
				}
			}
		}
		else{
			$_POST=array();
			header("location:sign_up.php");
		}

	}
?>


<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Sign in Page</title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link href="signin.css" rel="stylesheet">

	</head>

	<body>

		<div class="container">

			<form class="form-signin" action="sign_in.php" method="post">
				<h2 class="form-signin-heading">Please sign in</h2>
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password" autocomplete="off">
				<?php
					if (isset($info) and $info != ""){
						echo $info."<br>";
					}
				?>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="sign_in" value="sign in">Sign in</button>
				<button class="btn btn-lg btn-success btn-block" type="submit" name="sign_up" value="sign up">Sign up</button>
			</form>

		</div> <!-- /container -->
	</body>
</html>


