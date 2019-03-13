<?php
	require_once("util.php");
	session_start();
    if (!loggato()){
		    header('Location: ./../index.php');
		    exit;
    }	
    $mysqliConn=get_my_db();
    $username=$_SESSION["username"];
    
?>
<html lang="it">
	<head>
		<meta charset="utf-8"> 
    	<meta name = "author" content = "PWEB">
    	<meta name = "keywords" content = "game">
   	 	<link rel="icon" href="./../img/favicon.png">
		<link rel="stylesheet" href="./../css/styleTutorial.css" type="text/css" media="screen">
		<script src="./../js/tutorial.js"></script>
		<script src="./../js/Mappa.js"></script>
		<script src="./../js/Player.js"></script>
		<script src="./../js/Enemy.js"></script>
		<script src="./../js/EnemyMissile.js"></script>
		<script src="./../js/Missile.js"></script>
		<title>Space Invaders - Tutorial</title>
	</head>
	<body onload="beginTutorial()">
		<div id="game">

			<div id="title">
				<img id="immagineTitolo" src="./../img/title.png" alt="Space invaders text" >
			</div>
			<div id="mapContainer">
				<div id="map">
					<div id=player ></div>
				</div>
			</div>
			<div id="infoContainer">
				<div id="ScoreContainer">
					Score 
					<div id="score">
						0
					</div>
				</div>
				<div id="lifeContainer">
					LIVES
					<img id="life1" src="./../img/greenShip.png" alt="life1 img" width="90" height="48">
					<img id="life2" src="./../img/greenShip.png" alt="life2 img" width="90" height="48">
					<img id="life3" src="./../img/greenShip.png" alt="life3 img" width="90" height="48">
				</div>
				<div id="levelContainer">
					LEVEL
					<div id="level">
						TUTORIAl
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>	