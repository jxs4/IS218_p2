<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		
		session_start();

		$servername = "sql1.njit.edu";
		$username = "jxs4";
		$password = "PLBIaZdiV";
		$dbname = "jxs4";
	
		//Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		$email = $_POST['email'];

		$sql = "SELECT * from accounts where email = '$email'";
		$result = $conn->query($sql);
		$info = "";
		if ($result->num_rows > 0) {
    		$info = "Email address already exists.";
		}
		else{
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$phone = $_POST['phone'];
			$birthday = $_POST['birthday'];
			$gender = $_POST['gender'];
			$password = $_POST['password'];
			$sql = "INSERT into accounts (email, fname, lname, phone, birthday, gender, password) values('$email', '$fname', '$lname', '$phone', '$birthday', '$gender', '$password')";
			$result = $conn->query($sql);
			$_SESSION["fname"] = $fname;
			$_SESSION["lname"] = $lname;
			header("location:sign_in.php");
		}
	}
?> 


<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Signin Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link href="signin.css" rel="stylesheet">
	</head>

	<body>

		<div class="container">

			<form class="form-signin" action="sign_up.php" method="post">
				<h2 class="form-signin-heading">Please sign up</h2>
				<label for="inputFname" class="sr-only">Email address</label>
				<input type="text" id="inputFname" class="form-control" placeholder="First Name" required autofocus name="fname">
				<label for="inputLname" class="sr-only">Email address</label>
				<input type="text" id="inputLname" class="form-control" placeholder="Last Name" required autofocus name="lname">
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password" autocomplete="off">
				<label for="inputPhone" class="sr-only">Phone Number</label>
				<input type="text" id="inputPhone" class="form-control" placeholder="Phone Number" required autofocus name="phone">
				<label for="inputBirthday" class="sr-only">Birthday</label>
				<input type="date" id="inputDate" class="form-control" placeholder="Birthday" required autofocus name="birthday">
				<label for="inputGender" class="sr-only">Gender</label>
				<input type="text" id="inputGender" class="form-control" placeholder="Gender" required autofocus name="gender">
				<button class="btn btn-lg btn-success btn-block" type="submit" name="sign up" value="sign up">Sign up</button>
				<div>If you already have an account, please <a href="sign_in.php">sign in!</a></div>
				<?php
				 	if ($info != ""){
				 		echo $info."<br>";
				 	}
				?>
			</form>

		</div> <!-- /container -->
	</body>
</html>


