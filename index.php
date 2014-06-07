<?php

	session_start();
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
		//U slucaju da je autentikacija korisnika uspesna, nesto ce se  izvrsiti ovde.
	}else{
		header("location:login.php");
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<title>Online Reminder</title>
		<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
		
		<link rel="stylesheet" href="css/skeleton.css" />
		
		<link rel="stylesheet" href="css/style.css" />
		
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

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
        
		<script type="text/javascript" src="js/scripts.js"></script>
		
		<!--[if lt IE 7]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
			<link rel="stylesheet" href="css/ie.css" />
		<![endif]-->
	</head>
	<body>
	<div id="container">
		<nav class="clearfix">
			<ul class="clearfix">
				<li><a href="newuser.php">New User</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
			<a href="#" id="pull">Menu</a>
		</nav>
		
		<div id="main">
			<div class="container gridster" id="data">
			
			<div class="eight columns">
				<div id="addNewEntry">
					<form action="addItem.php" method="post">
							<input type="text" name="title" id="title" class="input" placeholder="What's on your mind?"/>
							<textarea placeholder="Brief description..." maxlength="54" name="description" id="description"></textarea>
							<input type="submit" name="addEntry" id="addEntry" value="Add" />
					</form>
				</div><!--end addNewEntry-->
			</div>
			
			<div id="todo">
				<?php
				
				require 'functions/todo.php';
				$db = new Db();
				$query = "SELECT * FROM todo ORDER BY id asc";
				$results = $db->mysql->query($query);
				
				if($results->num_rows) {
					while($row = $results->fetch_object()) {
						$title = $row->title;
						$description = $row->description;
						$id = $row->id;
						
				echo '<div class="item four columns">';
				
				$data = <<<EOD
					<h4>$title</h4>
					<p>$description</p>
					<input type="hidden" name="id" id="id" value="$id" />
					
					<div class="options">
						<!--<a class="editEntry bt-btn default" href="#">E</a>-->
                        <input type="checkbox" id="deletecheckbox" class="deleteEntryAnchor" onclick="window.location.href='delete.php?id=$id'"/>
					</div>
EOD;
						echo $data;
						echo '</div>';
					} // end while
				}
				else {
					echo "<div class=\"item four columns\" style=\"text-align: center;\"><p>You finished all your tasks....</p><h4>Add some more!</h4></div>";
				}	
				?>
			</div><!--end todo-->
			</div>
		</div><!--end main-->
	</div><!--end container-->
</body>
</html>