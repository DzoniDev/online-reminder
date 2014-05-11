<?php
$database = "db_name";  // the name of the database.
$server = "db_host"  // server to connect to.
$db_user = "db_user";  // mysql username to access the database with.
$db_pass = "db_pass";  // mysql password to access the database with.
$table = "db_table";    // the table that this script will set up and use.
$link = mysql_connect($server, $db_user, $db_pass);
mysql_select_db($database,$link);
?>