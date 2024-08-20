<?php
//This script will handle login
session_start();

// check if the user is already logged in
// if(isset($_SESSION['username']))
// {
//     header("location: welcome_login.php");
//     exit;
// }
require_once "config.php";

$username = "";
$password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
		$pass = $password;
    }


if(empty($err))
{
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    // $param_username = $username;
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $username, $password, $dt);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if($password == $pass)
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: welcome_login.php");
                            
                        }
                    }

                }

    }
}  


}


?>












<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>MoodSync : Login</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
		integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="./style.css"> -->

	<style>
		body {
            /* position: absolute; */
			background-image: linear-gradient(135deg, #8ab07a 30%, #72a29a 70%, #46496a);
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
			box-shadow: 0 0 20px 6px #00703fcb;
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
			background: #387e6fb5;
			overflow: hidden;
			box-sizing: border-box;
			}
			.box-form .left .overlay h1 {
			font-size: 6vmax;
			line-height: 1;
			margin-top: 35%;
			margin-bottom: 20px;
            margin-left: 27%;
			display: none;
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
			color: #3C6B5F;
			width: 350px;
			font-size: 6vmax;
			line-height: 0;
			text-align: left;
			align-items: start;
			margin-left: 2%;
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
			box-shadow: 0px 4px 20px 0px #49c628a6;
			background-image: linear-gradient(135deg, #8ab07a 20%, #72a29a 60%, #387e6fb5);
			margin-left: 20px;
			margin-bottom: 7%;
			}

			.box-form .right button:hover{
			background: linear-gradient(135deg, #70F570 10%, #49C628 100%);;
			color: #2b1055;
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
			/* The alert message box */

			.alert{
				display: none;
			}
			.alert.active {
			padding: 0px;
			background-color: #f44336; /* Red */
			color: white;
			height: 3em;
			width: 100%;
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
			}

			/* The close button */
			.closebtn {
			margin-left: 15px;
			color: white;
			font-weight: bold;
			float: right;
			font-size: 22px;
			line-height: 20px;
			cursor: pointer;
			transition: 0.3s;
			}

			/* When moving the mouse over the close button */
			.closebtn:hover {
			color: black;
			}
	</style>

</head>

<body>
	<!-- partial:index.partial.html -->
	<div class="box-form">
		<div class="left">
			<div class="overlay">
				<h1><div class="t1">Swift </div>
                <!-- <div class="t2">The Audio</div>
                <div class="t3">Alchemist.</div></h1> -->

			</div>
		</div>


		<div class="right">
			<h5>LOGIN</h5>

            <form action="" method="post">
				<div class="inputs">
					<input type="text" class="form-control" name="username" id="inputEmail4" placeholder="User Name">
					<br>
      				<input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password">
				</div>
                <br><br><br>
                <button type="submit" class="btn btn-primary">Login</button>
			</form>

			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, recusandae?</p>
		</div>

	</div>
	<!-- partial -->

	<div class="alert">
	<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	This is an alert box.
	</div>

	<script type="text/javascript">
		const alert = document.querySelectorAll(".alert");
		if(!empty($err)){
			alert.classList.add("active");
		}
	</script>

</body>

</html>