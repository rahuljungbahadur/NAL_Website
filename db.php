<?php
DEFINE ('DB_USER', 'root');
DEFINE('DB_DATABASE', 'nal');
DEFINE('DB_PWD', '');
DEFINE('DB_HOST', 'localhost');
//making connection
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE) or die ('could not connect to mysql database'. mysqli_connect_error());
?>