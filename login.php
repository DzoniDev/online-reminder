<?php 
if(isset($_POST) && !empty($_POST))
{
session_start();
include("functions/mysql.php"); //including config.php in our file
$username = mysql_real_escape_string(stripslashes($_POST['username'])); //Storing username in $username variable.
$password = mysql_real_escape_string(stripslashes(md5($_POST['password']))); //Storing password in $password variable.


$match = "select id from $table where username = '".$username."' and password = '".$password."';"; 

$qry = mysql_query($match);

$num_rows = mysql_num_rows($qry); 



if ($num_rows <= 0) { 

echo "Sorry, there is no username $username with the specified password.";

echo "Try again";

exit; 

} else {



$_SESSION['user']= $_POST["username"];
header("location:index.php");
// It is the page where you want to redirect user after login.
}
}else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Online Reminder - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
	
    <!-- Loading Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	<style>
		body{
			background: url("images/bg_login.jpg") no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		
		login{
			width: 250px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin: -100px 0 0 -125px;
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
		.signup{
			position: absolute;
			bottom: 4%;
			left: 3%;			
		}
	</style>
  </head>
  <body>
	<login>
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-signin" id = "login_form" >
		<div style="border-radius: 6px;">
		<input type="text" placeholder="Username" name="username" class="form-control flat up" />
		<input type="password" placeholder="Password" name="password" class="form-control flat down" />
		</div>
			<input class="btn btn-embossed btn-info" type="submit" style="margin-top: 20px; width: 100% !important;" value="Log In"></input>
		</form>
	</login>
  </body>
</html>
<?php } ?>