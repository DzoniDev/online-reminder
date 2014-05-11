	<?php
	session_start();
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
		//U slucaju da je autentikacija korisnika uspesna, nesto ce se  izvrsiti ovde.
	}else{
		header("location:login.php");
	}

	include("functions/mysql.php"); 
	//including config.php in our file

	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) 
		&& !empty($_POST['email'])){
		// Now checking user name and password is entered or not.
		$first_name= mysql_real_escape_string($_POST['firstname']);
		$last_name= mysql_real_escape_string($_POST['lastname']);
		$username = mysql_real_escape_string(stripslashes($_POST['username']));
		$password = mysql_real_escape_string(stripslashes(md5($_POST['password'])));
		$mail = mysql_real_escape_string($_POST['email']);
		$check = "SELECT * from users where username = '".$user."'";
		$qry = mysql_query($check);
		$num_rows = mysql_num_rows($qry); 

		if($num_rows > 0){
		// Here we are checking if username is already exist or not.

		echo "The username you have entered is already exist. Please try another username.";
		header("Refresh: 3; URL=signup.php");
		exit;
	}

	// Now inserting record in database.
	$query = "INSERT INTO users (firstname,lastname,username,password,email,is_active) VALUES ('".$first_name."','".$last_name."','".$username."','".$password."','".$mail."','1');";
		mysql_query($query);
		
		echo "Thank You for Registration.";
		header("Refresh: 3; URL=index.php");
		exit;
	}

	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Reminder - New User</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
		
		<!-- Loading Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- Loading Flat UI -->
		<link href="css/flat-ui.css" rel="stylesheet">

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
		<!--[if lt IE 9]>
		  <script src="js/html5shiv.js"></script>
		  <script src="js/respond.min.js"></script>
		<![endif]-->
		<style>
			body{
				background: url("images/bg_signup.jpg") no-repeat center center fixed; 
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
			
			register{
				width: 250px;
				height: 260px;
				position: absolute;
				left: 50%;
				top: 50%;
				margin: -130px 0 0 -125px;
				-webkit-border-radius: 2px;
				-moz-border-radius: 2px;
				-ms-border-radius: 2px;
				-o-border-radius: 2px;
				border-radius: 2px;
				/*border: 1px solid #F2F2F2;
				background: #F9F9F9;
				-webkit-box-shadow: 0px 0px 15px 0px rgba(33,33,33,0.55);
				-moz-box-shadow: 0px 0px 15px 0px rgba(33,33,33,0.55);
				box-shadow: 0px 0px 15px 0px rgba(33,33,33,0.55);*/
				text-align: center;
			}
			.up{
				border-top-left-radius: 6px !important;
				border-top-right-radius: 6px !important;
				border-bottom-right-radius: 0px  !important;
				border-bottom-left-radius: 0px !important;
				border: none !important;
				border-bottom: 1px solid #eee !important;
				padding: 10px;
			}
			.up:hover{
				border: none !important;
				border-bottom: 1px solid #eee !important;
			}
			.up:focus{
				border: none !important;
				border-bottom: 1px solid #eee !important;
			}
			.middle{
				border-top-left-radius: 0px !important;
				border-top-right-radius: 0px !important;
				border-bottom-right-radius: 0px  !important;
				border-bottom-left-radius: 0px !important;
				border: none !important;
				border-bottom: 1px solid #eee !important;
				border-top: 1px solid #eee !important;
				padding: 10px;
			}
			.middle:hover{
				border: none !important;
				border-bottom: 1px solid #eee !important;
				border-top: 1px solid #eee !important;
			}
			.middle:focus{
				border: none !important;
				border-bottom: 1px solid #eee !important;
				border-top: 1px solid #eee !important;
			}
			.down{
				border-top-left-radius: 0px !important;
				border-top-right-radius: 0px !important;
				border-bottom-right-radius: 6px !important;
				border-bottom-left-radius: 6px !important;
				border: none !important;
				border-top: 1px solid #eee !important;
				padding: 10px;
				-webkit-box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.15);
				box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.15);
			}
			.down:hover{
				border: none !important;
				border-top: 1px solid #eee !important;
				-webkit-box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.15);
				box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.15);
			}
			.down:focus{
				border: none !important;
				border-top: 1px solid #eee !important;
				-webkit-box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.15);
				box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.15);
			}
			.login{
				position: absolute;
				bottom: 4%;
				left: 3%;			
			}
			
			/* Navigation */
			
			/* Clearfix */
			.clearfix:before,
			.clearfix:after {
				content: " ";
				display: table;
			}
			.clearfix:after {
				clear: both;
			}
			.clearfix {
				*zoom: 1;
			}

			/* Basic Styles */
			nav {
				height: 60px;
				width: 100%;
				background: #0764AA;
				font-size: 18px !important;
				text-transform: uppercase;
				font-family: Myriad Pro, sans-serif;
				font-weight: bold;
				position: relative;
			}
			nav ul {
				margin: 0;
				padding: 0;
				width: 400px;
				height: 60px;
			}
			nav li {
				display: inline;
				float: left;
			}
			nav a {
				color: #fff !important;
				display: inline-block;
				width: 120px;
				text-align: center;
				text-decoration: none;
				line-height: 60px;
			}
			nav li a {
				box-sizing:border-box;
				-moz-box-sizing:border-box;
				-webkit-box-sizing:border-box;
			}
			nav li:last-child a {
				border-right: 0;
			}
			nav a:hover, nav a:active {
				background-color: #0974C4;
				-webkit-transition: 0.25s;
				transition: 0.25s;
			}
			nav a#pull {
				display: none;
			}

			/*Styles for screen 600px and lower*/
			@media screen and (max-width: 600px) {
				nav { 
					height: auto;
				}
				nav ul {
					width: 100%;
					display: block;
					height: auto;
				}
				nav li {
					width: 50%;
					float: left;
					position: relative;
				}
				nav li a {
					border-bottom: 1px solid #0974C4;
					border-right: 1px solid #0974C4;
				}
				nav a {
					text-align: left;
					width: 100%;
					text-indent: 25px;
				}
			}

			/*Styles for screen 515px and lower*/
			@media only screen and (max-width : 480px) {
				nav {
					border-bottom: 0;
				}
				nav ul {
					display: none;
					height: auto;
				}
				nav a#pull {
					display: block;
					background-color: #0764AA;
					width: 100%;
					position: relative;
				}
				nav a#pull:after {
					content:"";
					background: url('../images/nav-icon.png') no-repeat;
					width: 30px;
					height: 30px;
					display: inline-block;
					position: absolute;
					right: 15px;
					top: 20px;
				}
			}

			/*Smartphone*/
			@media only screen and (max-width : 320px) {
				nav li {
					display: block;
					float: none;
					width: 100%;
				}
				nav li a {
					border-bottom: 1px solid #0974C4;
				}
			}
		</style>	
		<script>
			$(function() {
				var pull 		= $('#pull');
					menu 		= $('nav ul');
					menuHeight	= menu.height();

				$(pull).on('click', function(e) {
					e.preventDefault();
					menu.slideToggle();
				});

				$(window).resize(function(){
					var w = $(window).width();
					if(w > 320 && menu.is(':hidden')) {
						menu.removeAttr('style');
					}
				});
			});
		</script>
	</head>
	<body>
		<nav class="clearfix">
			<ul class="clearfix">
				<li><a href="index.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
				<!-- <li style="width: 150px!important; text-align: center;"><a><?php //echo "WELCOME ". $_SESSION['user']; ?></a></li> -->
			</ul>
			<a href="#" id="pull">Menu</a>
		</nav>
		<register>
			<form action="<?php $_SERVER['PHP_SELF']?>" method="post" class="form-signup">
				<div style="border-radius: 6px;">
					<input type="text" name="firstname" size="20" placeholder="What's your name?'" class="form-control flat up" />
					<input type="text" name="lastname" size="20" placeholder="And your last name..." class="form-control flat middle" />
					<input type="text" name="username" size="20" placeholder="Also your username is?" class="form-control flat middle" />
					<input type="password" name="password" size="20" placeholder="Shh don't tell this to anyone..." class="form-control flat middle" />
					<input type="text" name="email" size="20" placeholder="Where can I send spam?" class="form-control flat down" />
				</div>
					<input type="submit" value="Create user" class="btn btn-embossed btn-info" style="margin-top: 20px; width: 100% !important;"></input>
			</form>
		</register>
	</body>
</html>