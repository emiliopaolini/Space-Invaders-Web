<?php
	require_once("util.php");
	session_start();
    if (!loggato()){
		    header('Location: ./../index.php');
		    exit;
    }
    $mysqliConn=get_my_db();

    $username=$_SESSION["username"];
    $extraLife=$_SESSION["extra"];
    $shieldsNumber=$_SESSION["shieldsNumber"];
?>
<html lang="it">
	<head>
		<meta charset="utf-8">
    	<meta name = "author" content = "PWEB">
    	<meta name = "keywords" content = "game">
		<link rel="icon" href="./../img/favicon.png">
		<link rel="stylesheet" href="./../css/styleGame.css" type="text/css" media="screen">
		<script src="./../js/game.js"></script>
		<script src="./../js/Explosion.js"></script>
		<script src="./../js/EnemyMissile.js"></script>
		<script src="./../js/engine.js"></script>
		<script src="./../js/Mappa.js"></script>
		<script src="./../js/Shield.js"></script>
		<script src="./../js/Enemy.js"></script>
		<script src="./../js/Player.js"></script>
		<script src="./../js/Missile.js"></script>
		<script src="./../js/BonusEnemy.js"></script>
		<title>Space Invaders - Game</title>
	</head>
	<body onload="beginCountdown()">
		<div id="game">
			<div id="title">
				<img id="immagineTitolo" src="./../img/title.png" alt="Space invaders text" >
			</div>
			<div id="mapContainer">
				<div id="map">
					<?php
						if($_SESSION["color"]=="green"){
							echo "<div id=player class=green></div>";
						}
						if($_SESSION["color"]=="red"){
							echo "<div id=player class=red></div>";
						}
						if($_SESSION["color"]=="yellow"){
							echo "<div id=player class=yellow></div>";
						}
						if($_SESSION["color"]=="pink"){
							echo "<div id=player class=pink></div>";
						}
					?>

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
					<?php
						if($extraLife){
							 echo '<script>',
      						'localStorage.setItem("extraLife",true);',
      						'</script>';

							echo "<img id=life4 src=./../img/greenShip.png alt=life4img  width=90 height=48>";
						}
						else{
							 echo '<script>',
      						'localStorage.setItem("extraLife",false);',
      						'</script>';
						}
						 echo '<script>',
      					'localStorage.setItem("shieldsNumber",'.$shieldsNumber.');',
      					'</script>';

					?>
				</div>
				<div id="levelContainer">
					LEVEL
					<div id="level">
						1
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
