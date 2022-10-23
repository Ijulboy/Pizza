<?php
	
$db_host = "localhost";
$db_user = "julia";
$db_password = "fhxbWU9z";
$db_base = "dbpizza";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_base) or die("Ошибка соединения: " . mysql_error());

/*mysql_select_db($db_base);
mysql_set_charset('utf8', $con);}*/
?>