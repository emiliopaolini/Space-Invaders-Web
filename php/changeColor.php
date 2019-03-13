<?php
	require_once("util.php");
	session_start();
	$user=$_SESSION["username"];
	$colorSelected=$_GET["colorSelected"];	
	$mysqli=get_my_db();
	$userId=getUserId($mysqli,$user);
	$_SESSION["color"]=$colorSelected;

	$query="UPDATE user SET color='".$colorSelected."' WHERE userId='".$userId."';";
	$queryResult=eseguiQuery($mysqli,$query);

?>