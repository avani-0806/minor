<?php
require_once "config.php";

$username = "";
$password = "";
$confirm_password = "";
$username_err = "";
$password_err = "";
$confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        // $sql = "SELECT id FROM users WHERE username = ?";
        // $stmt = mysqli_prepare($conn, $sql);
        // if($stmt)
        // {
        //     mysqli_stmt_bind_param($stmt, "s", $param_username);

        //     // Set the value of param username
        //     $param_username = trim($_POST['username']);

        //     // Try to execute this statement
        //     if(mysqli_stmt_execute($stmt)){
        //         mysqli_stmt_store_result($stmt);
        //         if(mysqli_stmt_num_rows($stmt) == 1)
        //         {
        //             $username_err = "This username is already taken"; 
        //         }
        //         else{
        //             $username = trim($_POST['username']);
        //         }
		// 		mysqli_stmt_close($stmt);
        //     }
        //     else{
        //         echo "Something went wrong";
        //     }
        // }
		$username = trim($_POST['username']);
    }

    // mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 3){
    $password_err = "Password cannot be less than 3 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = $password;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: welcome_login.php");
        }
        else{
            header("https://en.wikipedia.org/wiki/Taylor_Swift");
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>MoodSync : SignUp</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
		integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="./style.css"> -->

	<style>
		body {
            /* position: absolute; */
			background-image: linear-gradient(135deg, #ffb2bc 10%, #554A52 100%);
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
			font-family: "Open Sans", sans-serif;
			color: #333333;
            margin-top: 3%;
			}

			.box-form {
			margin: 0 auto;
			width: 80%;
			background: #FFFFFF;
			border-radius: 10px;
			overflow: hidden;
			display: flex;
			flex: 1 1 100%;
			align-items: stretch;
			justify-content: space-between;
			box-shadow: 0 0 20px 6px #6f095c85;
			}
			@media (max-width: 980px) {
			.box-form {
				flex-flow: wrap;
				text-align: center;
				align-content: center;
				align-items: center;
			}
			}
			.box-form div {
			height: auto;
			width: 1500px;
			}
			.box-form .left {
			color: #FFFFFF;
			background-size: cover;
			background-repeat: no-repeat;
			background-image: url("assets/swift.jpg");
			overflow: hidden;
			}
			.box-form .left .overlay {
			padding: 30px;
			width: 100%;
			height: 100%;
			background: #b1797aad;
			overflow: hidden;
			box-sizing: border-box;
			}
			.box-form .left .overlay h1 {
			font-size: 6vmax;
			line-height: 1;
			margin-top: 120px;
			margin-bottom: 20px;
            margin-left: 5%;
			}
            .t1{
			margin-bottom: 40px;
            }
            .t2, .t3{
            font-size: 5vmax;
            }
			.box-form .left .overlay span p {
			margin-top: 30px;
			font-weight: 900;
			}
			.box-form .left .overlay span a {
			background: #3b5998;
			color: #FFFFFF;
			margin-top: 10px;
			padding: 14px 50px;
			border-radius: 100px;
			display: inline-block;
			box-shadow: 0 3px 6px 1px #042d4657;
			}
			.box-form .left .overlay span a:last-child {
			background: #1dcaff;
			margin-left: 30px;
			}
			.box-form .right {
			padding: 30px;
			overflow: hidden;
			}
			@media (max-width: 400px) {
			.box-form .right {
				width: 100%;
			}
			}
			.box-form .right h5 {
			color: #A2766D;
			width: 350px;
			font-size: 6vmax;
			line-height: 0;
			text-align: center;
			align-items: start;
			margin-left: 0px;
            margin-bottom: 85px;
			}

			.box-form .right p {
			font-size: 14px;
			color: #fffefe;
            margin-bottom: 75px;
			}
			.box-form .right .inputs {
			
			width: 230%;
			overflow: hidden;
			margin-left: 20px;
			}
			.box-form .right input {
			width: 40%;
			padding: 5px;
			margin-left: 20px;
			margin-left: 0px;
			margin-top: 25px;
			font-size: 16px;
			border: none;
			outline: none;
			border-bottom: 2px solid #B0B3B9;
			
			}
			.box-form .right button {
			/* float: right; */
			color: #fff;
			font-size: 16px;
			padding: 12px 35px;
			border-radius: 50px;
			display: inline-block;
			border: 0;
			outline: 0;
			box-shadow: 0px 4px 20px 0px #c6285fa6;
			background-image: linear-gradient(135deg, #ffb2bc 10%, #554A52 100%);
			margin-left: 20px;
			margin-bottom: 13%;
			}

			.box-form .right button:hover{
			background: linear-gradient(135deg, #70F570 10%, #49C628 100%);;
			color: #2b1055;
			box-shadow: 0px 4px 20px 0px #49c628a6;
			}

			label {
			display: block;
			position: relative;
			margin-left: 30px;
			}

			label::before {
			content: ' \f00c';
			position: absolute;
			font-family: FontAwesome;
			background: transparent;
			border: 3px solid #70F570;
			border-radius: 4px;
			color: transparent;
			left: -30px;
			transition: all 0.2s linear;
			}

			label:hover::before {
			font-family: FontAwesome;
			content: ' \f00c';
			color: #fff;
			cursor: pointer;
			background: #70F570;
			}

			label:hover::before .text-checkbox {
			background: #70F570;
			}

			label span.text-checkbox {
			display: inline-block;
			height: auto;
			position: relative;
			cursor: pointer;
			transition: all 0.2s linear;
			}

			label input[type="checkbox"] {
			display: none;
		}
	</style>

</head>

<body>
	<!-- partial:index.partial.html -->
	<div class="box-form">
		<div class="left">
			<div class="overlay">
				<!-- <h1><div class="t1">MoodSync: </div>
                <div class="t2">The Audio</div>
                <div class="t3">Alchemist.</div></h1> -->

			</div>
		</div>


		<div class="right">
			<h5>Sign Up</h5>

            <form action="" method="post">
				<div class="inputs">
					<input type="text" class="form-control" name="username" id="inputEmail4" placeholder="User Name">
					<br>
      				<input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password">
                    <br>
                    <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password">
				</div>
                <br><br><br>
                <button type="submit" class="btn btn-primary">Register</button>
			</form>

		</div>

	</div>
	<!-- partial -->

</body>

</html>