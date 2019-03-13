<?php
	require_once("util.php");
	$id=$_GET["id"];
	$id++;
	$mysqli=get_my_db();
	$query="SELECT * FROM shop WHERE itemId='".$id."';";
	$result=eseguiQuery($mysqli,$query);
	$riga=$result->fetch_assoc();
	echo "You are buying:";
	echo "<br/><br>";
	echo $riga["name"];
	echo "<br/><br>";
	echo $riga["description"];
	echo "<br/><br>";
	echo $riga["cost"]."$";
	echo "<br>";
	echo "<input type=button value=CONTINUE onclick=conferma(".$id.",".$riga['cost'].") id=conferma >";

	$link="./../img/".$riga['img'];
	
?>