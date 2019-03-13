<?php
	require_once("util.php");
	session_start();
	$text=$_GET["text"];
	$user=$_SESSION["username"];
	$mysqli=get_my_db();
	$userId=getUserId($mysqli,$user);
	$testo=controllaMysqli($mysqli,$text);
	$query="INSERT INTO post(text,userId) VALUES (N'".$text."','".$userId."');";
	$result=eseguiQuery($mysqli,$query);
	if($result==TRUE)
		getAllPosts($mysqli);
?>