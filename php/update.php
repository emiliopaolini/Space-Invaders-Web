<?php
	require_once("util.php");
	session_start();
	$user=$_SESSION["username"];
	$coinsEarned=$_GET["coinsEarned"];	
	$coinsTotal=$_SESSION["coins"]+$coinsEarned;
	$_SESSION["coins"]=$coinsTotal;
	$mysqli=get_my_db();
	$query="UPDATE user SET numeroPartite=numeroPartite+1,coins=coins+".$coinsEarned." WHERE username='".$user."';";
	$queryResult=eseguiQuery($mysqli,$query);

	$score=$_GET["score"];
	$flag=false;
	$queryData="SELECT * FROM user WHERE username='$user'; ";
	$result=eseguiQuery($mysqli,$queryData);

	if($result->num_rows>=1){
		$row=$result->fetch_assoc();
		$best=$row['best'];
		if($score>$best){
			$best=$score;
			$flag=true;
			$queryUpdate="UPDATE user SET best='".$best."' WHERE username='".$user."';";
			eseguiQuery($mysqli,$queryUpdate);
			echo "migliorato";
		}
	}

?>
