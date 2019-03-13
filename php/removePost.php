<?php
	require_once("util.php");
	session_start();
	$postId=$_GET["id"];
	
	$mysqli=get_my_db();
	$query="DELETE FROM post WHERE postId=".$postId.";";
	$result=eseguiQuery($mysqli,$query);
	if($result==TRUE)
		getAllPostsForAdmin($mysqli);
?>