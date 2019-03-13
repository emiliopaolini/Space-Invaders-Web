<?php
	require_once("util.php");
	session_start();
	$user=$_SESSION["username"];
	$itemId=$_GET["itemId"];	
	$equipped=$_GET["equipped"];
	$mysqli=get_my_db();
	$userId=getUserId($mysqli,$user);
	echo $equipped;
	$query="UPDATE buy SET equipped=".$equipped." WHERE userId='".$userId."' AND itemId='".$itemId."';";

	$queryResult=eseguiQuery($mysqli,$query);

?>