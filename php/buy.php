<?php
	session_start();
	require_once("util.php");
	$user=$_SESSION["username"];
	$mysqli=get_my_db();
	$itemId=$_GET["itemId"];
	$cost=$_GET["cost"];
	$userId=getUserId($mysqli,$user);
	
	$query2="INSERT INTO buy(userId, itemId) VALUES ('".$userId."','".$itemId."');";
	$result=eseguiQuery($mysqli,$query2);
	if($result==FALSE){
		echo "null";
		return;		
	}
	$_SESSION["coins"]-=$cost;
	$query="UPDATE user set coins='".$_SESSION["coins"]."' WHERE userId='".$userId."';";
	$result=eseguiQuery($mysqli,$query);
	
	if($result=== TRUE){
		echo getBoughtItems($mysqli,$user);
	}

?>