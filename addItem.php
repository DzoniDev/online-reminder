<?php

	require 'functions/todo.php';
	$db = new Db();

	// Dodavanje beleski
	if(isset($_POST['addEntry'])) {
		$query = "INSERT INTO todo VALUES('', ?, ?)";

		if($stmt = $db->mysql->prepare($query));
		$stmt->bind_param('ss', $_POST['title'], $_POST['description']);
		$stmt->execute();
		
		header('location: index.php');
		
	} else die($db->mysql->error);